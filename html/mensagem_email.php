<?php 

class mensagem { 
    public $mensagem = ''; 
    function get_mensagem($nome,$texto) 
	{ 
         $mensagem = '
<!DOCTYPE html PUBLIC>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>EneSec Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body style="margin: 0; padding: 0;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc;">
      <tr>
        <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0;">
          <a href="https://homol.redes.unb.br/enesec/"><img src="https://homol.redes.unb.br/enesec/img/logo.png" alt="EneSec logo" width="242" height="76" style="display: block;" />
        </td>
      </tr>
      <tr>
        <td bgcolor="#003366" style="padding: 40px 30px 40px 30px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 24px;">
                <b>Olá, ' . $nome . '!</b>
                <br><br>
              </td>
            </tr>
            <tr>
              <td align="justify" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                ' . $texto . '
                <br><br>
                Qualquer problema, basta entrar em contato através de nossos telefones ou pessoalmente.
                <br><br>    
                Atenciosamente,<br>
                Equipe da EneSec e Secretaria do Departamento de Engenharia Elétrica
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td bgcolor="#006633" style="padding: 30px 30px 30px 30px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                &reg; EneSec, 2017<br/>
                
                Você está recebendo esse e-mail porque está cadastrado em nosso site. Caso deseje parar de receber nossos e-mails, é necessário que delete sua conta <a href="https://homol.redes.unb.br/enesec/deletar_conta.html" style="color: #ffffff;"><font color="#ffffff">clicando aqui</font></a>.
              </td>
              <td align="right">
                <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
                      <a href="http://www.twitter.com/">
                        <img src="https://homol.redes.unb.br/enesec/img/twitter.jpg" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                      </a>
                    </td>
                    <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                      <td>
                        <a href="http://www.facebook.com/">
                          <img src="https://homol.redes.unb.br/enesec/img/facebook.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                      </a>
                    </td>
                  </tr>
                </table>
              </td>  
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
';
return $mensagem;
}

function mensagem_deletar_recuperar($texto) 
	{ 
        $mensagem = '
<!DOCTYPE html PUBLIC>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>EneSec Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body style="margin: 0; padding: 0;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc;">
      <tr>
        <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0;">
          <a href="https://homol.redes.unb.br/enesec/"><img src="https://homol.redes.unb.br/enesec/img/logo.png" alt="EneSec logo" width="242" height="76" style="display: block;" />
        </td>
      </tr>
      <tr>
        <td bgcolor="#003366" style="padding: 40px 30px 40px 30px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 16px;">
                ' . $texto . '
                <br><br>
                Qualquer problema, basta entrar em contato através de nossos telefones ou pessoalmente.
                <br><br>
                
                Atenciosamente,<br>
                Equipe da EneSec e Secretaria do Departamento de Engenharia Elétrica
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td bgcolor="#006633" style="padding: 30px 30px 30px 30px;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                &reg; EneSec, 2017<br/>
                
                Você está recebendo esse e-mail porque está cadastrado em nosso site. Caso deseje parar de receber nossos e-mails, é necessário que delete sua conta <a href="https://homol.redes.unb.br/enesec/" style="color: #ffffff;"><font color="#ffffff">clicando aqui</font></a>.
              </td>
              <td align="right">
                <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
                      <a href="http://www.twitter.com/">
                        <img src="https://homol.redes.unb.br/enesec/img/twitter.jpg" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                      </a>
                    </td>
                    <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                      <td>
                        <a href="http://www.facebook.com/">
                          <img src="https://homol.redes.unb.br/enesec/img/facebook.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                      </a>
                    </td>
                  </tr>
                </table>
              </td>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>';
return $mensagem;
    }  
	
	
} 
?>
