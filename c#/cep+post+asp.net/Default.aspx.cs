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
    protected void btnLogradouro_Click(object sender, EventArgs e)
    {
        //Chamando o método EnviaSMS
        obterLogradouro();
    }

    //Método para enviar SMS
    private void obterLogradouro()
    {
        //Informe seu nome de usúario
        string usuario = "meuUsuario";
        //Informe sua senha
        string senha = "minhaSenha";

        ASCIIEncoding encoding = new ASCIIEncoding();
        string parametros = "cep=" + txtCep.Text;
        parametros += ("&usuario=" + usuario);
        parametros += ("&senha=" + senha);


        // Preparando web request...
        StreamWriter myWriter = null;

        // Informando o método httpmethod=obterlogradouroauth
		// 
		// Uma lista de outros métodos e parametros pode ser obtida em: 
		// http://www.byjg.com.br/site/webservice.php/ws/cep
        HttpWebRequest myRequest = (HttpWebRequest)WebRequest.Create("http://www.byjg.com.br/site/webservice.php/ws/cep?httpmethod=obterlogradouroauth");
	    //myRequest.Proxy = new System.Net.WebProxy(ProxyString, true);

		//Informando o POST ao método
        myRequest.Method = "POST";
        myRequest.ContentType = "application/x-www-form-urlencoded";
	    byte [] bytes = System.Text.Encoding.ASCII.GetBytes(parametros);
        myRequest.ContentLength = bytes.Length;

		var result = "";

        try
        {
			System.IO.Stream os = myRequest.GetRequestStream ();
			os.Write (bytes, 0, bytes.Length); 
			os.Close ();

			System.Net.WebResponse resp = myRequest.GetResponse();
			if (resp== null) 
				result = "Sem resposta do servidor";
			else
			{
				System.IO.StreamReader sr = new System.IO.StreamReader(resp.GetResponseStream());
				result = sr.ReadToEnd().Trim();
			}
		}
        catch (Exception ex)
        {
			result = ex.Message;
        }

		txtCep.Text = string.Empty;
        lblRetorno.Text = result;
    }
}