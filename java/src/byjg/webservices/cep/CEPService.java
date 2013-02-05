/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package byjg.webservices.cep;

import byjg.webservices.ByJGBaseWebService;
import java.util.HashMap;

/**
 * Classe para abstrair as chamadas ao WebService ByJG para SMS
 *
 * @author jg
 */
public class CEPService extends ByJGBaseWebService {

	protected static final String SERVICE = "cep";

	protected String usuario = "";
	protected String senha = "";

	public CEPService(String usuario, String senha) {
		this.usuario = usuario;
		this.senha = senha;
	}

	/**
	 * Retorna a versao do WebService
	 *
	 * @return Versão
	 * @throws Exception
	 */
	public String obterVersao() throws Exception {
		return this.executeWebService(CEPService.SERVICE, "obterVersao", null);
	}

	/**
	 * Obtém o logradouro
	 *
	 * @param cep
	 * @return
	 * @throws Exception
	 */
	public String obterLogradouro(String cep) throws Exception {
		HashMap<String, String> params = new HashMap<String, String>();
		params.put("cep", cep);
		params.put("usuario", this.usuario);
		params.put("senha", this.senha);

		return this.executeWebService(CEPService.SERVICE, "obterLogradouroAuth", params);
	}

	/**
	 * Retorna o CEP à partir do logradouro.
	 * @param logradouro
	 * @param localidade
	 * @param UF
	 * @return
	 * @throws Exception
	 */
	public String obterCEP(String logradouro, String localidade, String UF) throws Exception {
		HashMap<String, String> params = new HashMap<String, String>();
		params.put("logradouro", logradouro);
		params.put("localidade", localidade);
		params.put("UF", UF);
		params.put("usuario", this.usuario);
		params.put("senha", this.senha);

		return this.executeWebService(CEPService.SERVICE, "obterCEPAuth", params);
	}
}
