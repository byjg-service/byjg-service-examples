/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package main;

import byjg.webservices.sms.*;
import byjg.webservices.cep.*;

/**
 *
 * @author jg
 */
public class Main {

	/**
	 * @param args the command line arguments
	 */
	public static void main(String[] args) {
		// TODO code application logic here
		try {
			SMSService sms = new SMSService("usuario", "senha");
			System.out.println(sms.obterVersao());
			System.out.println(sms.enviarSMS("11", "88889999", "Mensagem de teste"));
			System.out.println(sms.creditos());

			CEPService cep = new CEPService("usuario", "senha");
			System.out.println(cep.obterVersao());
			System.out.println(cep.obterLogradouro("22000123"));
			System.out.println(cep.obterCEP("logradouro", "rio de janeiro", "rj"));
		} catch (Exception ex) {
			System.out.println(ex.getMessage());
		}
	}
}
