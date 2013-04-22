using System;

//imports das bibliotecas necessárias
using System.Net;
using System.IO;
using System.Text;


public partial class _Default : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {

    }

    //Enviando SMS com POST no evento Click do button Enviar
    protected void btnEnviar_Click(object sender, EventArgs e)
    {
        //Chamando o método EnviaSMS
        EnviaSMS();
    }

    //Método para enviar SMS
    private void EnviaSMS()
    {
        //Informe seu nome de usúario
        string usuario = "meuUsuario";
        //Informe sua senha
        string senha = "minhaSenha";

        ASCIIEncoding encoding = new ASCIIEncoding();
        string parametros = "ddd=" + txtddd.Text;
        parametros += ("&celular=" + txtNumero.Text);
        parametros += ("&mensagem=" + txtMensagem.Text);
        parametros += ("&usuario=" + usuario);
        parametros += ("&senha=" + senha);


        // Preparando web request...
        StreamWriter myWriter = null;

        //Informando o método httpmethod=enviarsms                                             
        HttpWebRequest myRequest = (HttpWebRequest)WebRequest.Create("http://www.byjg.com.br/site/webservice.php/ws/sms?httpmethod=enviarsms");

        //Informando o POST ao método
        myRequest.Method = "POST";
        myRequest.ContentType = "application/x-www-form-urlencoded";
        myRequest.ContentLength = parametros.Length;

        try
        {
            myWriter = new StreamWriter(myRequest.GetRequestStream());

            // Envia os parametros
            myWriter.Write(parametros);

        }
        catch (Exception)
        {

            throw;
        }
        finally
        {
            myWriter.Close();
            txtddd.Text = string.Empty;
            txtNumero.Text = string.Empty;
            txtMensagem.Text = string.Empty;
            lblRetorno.Text = "Mensagem enviada com sucesso!";
        }
    }
}