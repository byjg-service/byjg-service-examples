<?php

################
##
## Selecione um dos métodos abaixo (RESTFul ou SOAP). Apenas um deles
##
##########################################

# Usar o método REST
#include("exemplo_sms_restful.php");

# Usar o método SOAP
include("exemplo_sms_soap.php");

echo enviarSMS("21", "99998888", "Mensagem de teste", "usuario", "senha");
echo "\n";

?>
