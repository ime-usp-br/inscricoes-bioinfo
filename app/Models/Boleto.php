<?php

namespace App\Models;

require_once(base_path('app/Http/SoapClient/nusoap.php'));

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\Inscricao;
use nusoap_client;

class Boleto extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscricao_id',
        'codigoIDBoleto',
        'dataVencimentoBoleto',
        'dataEfetivaPagamento',
        'valorDocumento',
        'valorDesconto',
        'valorEfetivamentePago',
        'statusBoletoBancario',
    ];

    public function inscricao()
    {
        return $this->belongsTo(Inscricao::class, "inscricao_id");
    }

    public function getStatus($atualizar = false)
    {
        $estados = [
            "E"=>"Emitido",
            "P"=>"Pago",
            "V"=>"Verificar",
            "C"=>"Cancelado"
        ];
        if($atualizar){
            $this->atualizarSituacao();
        }

        return $estados[$this->statusBoletoBancario];
    }

    public static function gerarBoletoRegistrado(Inscricao $inscricao, $valorDocumento, $valorDesconto)
    {
        $codigoUnidadeDespesa = env("WS_Codigo_Unidade_Despesa");
        $codigoFonteRecurso = env("WS_Codigo_Fonte_Recurso");
        $estruturaHierarquica = env("WS_Estrutura_Hierarquica");
        $informacoesBoletoSacado = 'Dúvidas ou demais informações, entrar em contato com o BioInfo pelo e-mail bioinformatica@usp.br';
        $instrucoesObjetoCobranca = 'Não receber após o vencimento';

        $clienteSoap = new nusoap_client(env("WSDL_URL"),'wsdl');
        
        $erro = $clienteSoap->getError();
        if ($erro){
            Log::error("Erro de conexão com o serviço WS-Boleto.");
            return false;
        }
        
        $soapHeaders = array('username' => env("WS_USERNAME"), 'password' => env("WS_PASSWORD")); 
        $clienteSoap->setHeaders($soapHeaders);

        $cpfCnpj = str_replace(array('.','-','/'), "", $inscricao->cpf);
        $tipo_sacado = "PF";
        
        $param = array ('codigoUnidadeDespesa' => $codigoUnidadeDespesa,
                        'codigoFonteRecurso' => $codigoFonteRecurso,
                        'estruturaHierarquica' => $estruturaHierarquica,
                        'dataVencimentoBoleto' => date("d/m/Y", strtotime("+5 days")),
                        'valorDocumento' => $valorDocumento,
                        'valorDesconto' => $valorDesconto,
                        'tipoSacado' => $tipo_sacado,
                        'cpfCnpj' => $cpfCnpj,
                        'nomeSacado' => utf8_decode($inscricao->nome),
                        'informacoesBoletoSacado' => utf8_decode($informacoesBoletoSacado),
                        'instrucoesObjetoCobranca' => utf8_decode($instrucoesObjetoCobranca)
                    );


        $result = $clienteSoap->call('gerarBoletoRegistrado', array('boletoRegistrado' => $param));
        
        if ($clienteSoap->fault) { 
            Log::error("Falha no cliente - Geração Código.");
            return false;
        } 
        if ($clienteSoap->getError()){    
            Log::error( $clienteSoap->getError());
            return false;
        }

        $boleto = Boleto::create([
            "codigoIDBoleto"=>$result["identificacao"]["codigoIDBoleto"],
            'valorDocumento' => $valorDocumento,
            'valorDesconto' => $valorDesconto,
        ]);

        $boleto->atualizarSituacao();
        
        return $boleto;
    }

    public function obterBoletoPDF()
    {
        $clienteSoap = new nusoap_client(env("WSDL_URL"),'wsdl');

        $erro = $clienteSoap->getError();
        if ($erro){
            Log::error("Erro de conexão com o serviço WS-Boleto.");
            return false;
        }
        
        $soapHeaders = array('username' => env("WS_USERNAME"), 'password' => env("WS_PASSWORD")); 
        $clienteSoap->setHeaders($soapHeaders);

        
        $param = array ('codigoIDBoleto' => $this->codigoIDBoleto);

        $result = $clienteSoap->call('obterBoleto', array('identificacao' => $param));
        
        if ($clienteSoap->fault) { 
            Log::error("Falha no cliente - Geração Código.");
            return false;
        } 
        if ($clienteSoap->getError()){    
            Log::error( $clienteSoap->getError());
            return false;
        }

	    return $result["boletoPDF"];
    }

    public function atualizarSituacao()
    {
        $clienteSoap = new nusoap_client(env("WSDL_URL"),'wsdl');

        $erro = $clienteSoap->getError();
        if ($erro){
            Log::error("Erro de conexão com o serviço WS-Boleto.");
            return false;
        }
        
        $soapHeaders = array('username' => env("WS_USERNAME"), 'password' => env("WS_PASSWORD")); 
        $clienteSoap->setHeaders($soapHeaders);

        
        $param = array ('codigoIDBoleto' => $this->codigoIDBoleto);

        $result = $clienteSoap->call('obterSituacao', array('identificacao' => $param));
        
        if ($clienteSoap->fault) { 
            Log::error("Falha no cliente - Geração Código.");
            return false;
        } 
        if ($clienteSoap->getError()){    
            Log::error( $clienteSoap->getError());
            return false;
        }

        $this->update([
            'dataVencimentoBoleto'=>$result["situacao"]["dataVencimentoBoleto"],
            'dataEfetivaPagamento'=>$result["situacao"]["dataEfetivaPagamento"],
            'valorEfetivamentePago'=>$result["situacao"]["valorEfetivamentePago"],
            'statusBoletoBancario'=>$result["situacao"]["statusBoletoBancario"],
        ]);

	    return true;
    }

    public function cancelarBoleto()
    {
        $clienteSoap = new nusoap_client(env("WSDL_URL"),'wsdl');

        $erro = $clienteSoap->getError();
        if ($erro){
            Log::error("Erro de conexão com o serviço WS-Boleto.");
            return false;
        }
        
        $soapHeaders = array('username' => env("WS_USERNAME"), 'password' => env("WS_PASSWORD")); 
        $clienteSoap->setHeaders($soapHeaders);

        
        $param = array ('codigoIDBoleto' => $this->codigoIDBoleto);

        $result = $clienteSoap->call('cancelarBoleto', array('identificacao' => $param));
        
        if ($clienteSoap->fault) { 
            Log::error("Falha no cliente - Geração Código.");
            return false;
        } 
        if ($clienteSoap->getError()){    
            Log::error( $clienteSoap->getError());
            return false;
        }

        if($result["situacao"]["statusBoletoBancario"] == "C"){
            return true;
        }else{
            Log::error("Falha ao cancelar boleto - call retornou status diferente de C");
            return false;
        }
    }
}
