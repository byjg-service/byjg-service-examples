/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package byjg.webservices;

import java.net.*;
import java.io.*;
import java.util.HashMap;
import java.util.Map;

import byjg.util.Base64;

/**
 *
 * @author jg
 */
public class ByJGBaseWebService {

	protected static final String WS_BYJG = "http://www.byjg.com.br/site/webservice.php/ws/";

	protected String proxyServer = null;
	protected int proxyPort = 0;
	protected String proxyUsername = null;
	protected String proxyPassword = null;

	protected String executeWebService(String service, String method, HashMap<String, String> params) throws MalformedURLException, IOException, ByJGWebServiceException {
		String strUrl = ByJGBaseWebService.WS_BYJG;

		strUrl += service + "?httpmethod=" + method;

		if (params != null) {
			for (Map.Entry<String, String> entry : params.entrySet()) {
				strUrl += "&" + entry.getKey() + "=" + URLEncoder.encode(entry.getValue(), "UTF-8");
			}
		}

		HttpURLConnection urlConnection;
		URL url = new URL(strUrl);

		if (this.proxyServer != null)
		{
			Proxy proxy = new Proxy(Proxy.Type.HTTP, new InetSocketAddress(this.proxyServer, this.proxyPort));
			urlConnection = (HttpURLConnection)url.openConnection(proxy);

			if (this.proxyUsername != null)
			{
				String encoded = Base64.encode(this.proxyUsername + ":" + this.proxyPassword);
				urlConnection.setRequestProperty("Proxy-Authorization", "Basic " + encoded);
			}
		}
		else
		{
			urlConnection = (HttpURLConnection)url.openConnection();
		}

		urlConnection.connect();

		BufferedReader in = new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));

		String inputLine;
		String result = "";
		while ((inputLine = in.readLine()) != null) {
			result += inputLine;
		}

		in.close();

		if (result.contains("ERR|")) {
			throw new ByJGWebServiceException(result.substring(4));
		}

		return result.substring(3);

	}

	public void setProxy(String proxyServer, int proxyPort)
	{
		this.proxyServer = proxyServer;
		this.proxyPort = proxyPort;
	}

	public void setProxy(String proxyServer, int proxyPort, String username, String password)
	{
		this.setProxy(proxyServer, proxyPort);
		this.proxyUsername = username;
		this.proxyPassword = password;
	}

}
