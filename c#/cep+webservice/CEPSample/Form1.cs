using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace CEPSample
{
	public partial class Form1 : Form
	{
		public Form1()
		{
			InitializeComponent();
		}

		private void button1_Click(object sender, EventArgs e)
		{
			br.com.byjg.CEPService cepclass = new CEPSample.br.com.byjg.CEPService();
			lblResposta.Text = cepclass.obterLogradouroAuth(txtCEP.Text, txtUsuario.Text, txtSenha.Text);
		}

		private void button2_Click(object sender, EventArgs e)
		{
			br.com.byjg.CEPService cepclass = new CEPSample.br.com.byjg.CEPService();
			listResposta.Items.AddRange(cepclass.obterCEPAuth(txtLogradouro.Text, txtCidade.Text, txtEstado.Text, txtUsuario.Text, txtSenha.Text));
		}

	}
}
