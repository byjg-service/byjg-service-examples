VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   5025
   ClientLeft      =   60
   ClientTop       =   450
   ClientWidth     =   8910
   LinkTopic       =   "Form1"
   ScaleHeight     =   5025
   ScaleWidth      =   8910
   StartUpPosition =   3  'Windows Default
   Begin VB.CommandButton Command2 
      Caption         =   "Sair"
      Height          =   375
      Left            =   7260
      TabIndex        =   5
      Top             =   840
      Width           =   1395
   End
   Begin VB.TextBox txtCEP 
      Height          =   285
      Left            =   240
      TabIndex        =   0
      Top             =   360
      Width           =   1215
   End
   Begin VB.TextBox txtEscolha 
      Height          =   285
      Left            =   240
      TabIndex        =   7
      Top             =   4620
      Width           =   8055
   End
   Begin VB.ListBox lstResultado 
      Height          =   1425
      Left            =   240
      TabIndex        =   6
      Top             =   3060
      Width           =   8055
   End
   Begin VB.CommandButton Command1 
      Caption         =   "Consultar"
      Height          =   375
      Left            =   7260
      TabIndex        =   4
      Top             =   240
      Width           =   1395
   End
   Begin VB.TextBox txtUF 
      Height          =   285
      Left            =   240
      TabIndex        =   3
      Top             =   2520
      Width           =   1095
   End
   Begin VB.TextBox txtLocalidade 
      Height          =   285
      Left            =   240
      TabIndex        =   2
      Top             =   1860
      Width           =   6675
   End
   Begin VB.TextBox txtLogradouro 
      Height          =   285
      Left            =   240
      TabIndex        =   1
      Top             =   1140
      Width           =   6675
   End
   Begin VB.Label Label1 
      AutoSize        =   -1  'True
      Caption         =   "CEP"
      Height          =   195
      Index           =   3
      Left            =   240
      TabIndex        =   11
      Top             =   120
      Width           =   315
   End
   Begin VB.Label Label1 
      AutoSize        =   -1  'True
      Caption         =   "UF"
      Height          =   195
      Index           =   2
      Left            =   240
      TabIndex        =   10
      Top             =   2280
      Width           =   210
   End
   Begin VB.Label Label1 
      AutoSize        =   -1  'True
      Caption         =   "Cidade"
      Height          =   195
      Index           =   1
      Left            =   240
      TabIndex        =   9
      Top             =   1620
      Width           =   495
   End
   Begin VB.Label Label1 
      AutoSize        =   -1  'True
      Caption         =   "Logradouro"
      Height          =   195
      Index           =   0
      Left            =   240
      TabIndex        =   8
      Top             =   900
      Width           =   810
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
' Agradecimentos a Jorge Barros
' Requer o SOAP Tool Kit instalado e associado ao projeto.

Private Sub Command1_Click()
   Dim Retorno As Variant, x_End() As String
      
   If Len(txtCEP.Text) > 0 Then
      If Len(txtCEP.Text) < 7 Then
         MsgBox "Necessário corretamente o CEP ou deixa-lo em branco!"
         txtCEP.SetFocus
         Exit Sub
      End If
      
      Retorno = Peg_CEP(txtCEP.Text, "usuario_criado", "senha_criada")
      
      If Mid(Retorno, 1, 4) <> "ERRO" Then
         x_End = Split(Retorno, ", ")
         
         txtLogradouro.Text = x_End(0)
         txtLocalidade.Text = x_End(2)
         txtUF.Text = x_End(3)
      End If
      
   Else
   
      If txtLogradouro.Text = "" Then
         MsgBox "Necessário informar Logradouro!"
         txtLogradouro.SetFocus
         Exit Sub
      End If
   
      If txtLocalidade.Text = "" Then
         MsgBox "Necessário informar Localidade!"
         txtLocalidade.SetFocus
         Exit Sub
      End If
      
      If txtUF.Text = "" Then
         MsgBox "Necessário informar UF!"
         txtUF.SetFocus
         Exit Sub
      End If
      
      Peg_Lg txtLogradouro.Text, txtLocalidade.Text, txtUF.Text, "usuario_criado", "senha_criada"
      
   End If
   
End Sub

Private Sub Command2_Click()
   Unload Me
End Sub

Private Sub txtCEP_KeyPress(KeyAscii As Integer)
   If InStr(1, "0123456789" & vbKeyDelete & Chr(8), Chr(KeyAscii)) = 0 Then KeyAscii = 0
End Sub

Private Sub lstResultado_Click()
   txtEscolha.Text = Str(lstResultado.ListIndex) & " = " & lstResultado.List(lstResultado.ListIndex)
End Sub

Private Sub lstResultado_DblClick()
   Dim xEnd() As String, xMsg As String, xx As Integer, xLbl(6) As String
    
    xLbl(0) = "CEP"
    xLbl(1) = "Logradouro"
    xLbl(2) = "Bairro"
    xLbl(3) = "Municipio"
    xLbl(4) = "UF"
    xLbl(5) = "IBGE"
    
    xEnd = Split(lstResultado.List(lstResultado.ListIndex), ",")
   
    xMsg = "Endereço escolhido" & vbCrLf & vbCrLf
    
    For xx = 0 To UBound(xEnd)
       xMsg = xMsg & xLbl(xx) & ": " & xEnd(xx) & vbCrLf
    Next
    
    MsgBox xMsg, vbOKOnly + vbInformation, "ENDEREÇO"
    
    
End Sub

Private Sub lstResultado_GotFocus()
   txtEscolha.Text = Str(lstResultado.ListIndex) & " = " & lstResultado.List(lstResultado.ListIndex)
End Sub

Private Sub lstResultado_KeyPress(KeyAscii As Integer)
   
   If KeyAscii = vbKeyUp Or KeyAscii = vbKeyDown Then
      txtEscolha.Text = Str(lstResultado.ListIndex) & " = " & lstResultado.List(lstResultado.ListIndex)
   ElseIf KeyAscii = vbKeyReturn Then
      lstResultado_DblClick
   End If
   
End Sub

Private Function Peg_CEP(x_CEP, CepUser, CepPWD) As Variant

  Dim webService As New SoapClient, vaRet As String
      
   If x_CEP = "" Or Len(x_CEP) < 7 Then
      MsgBox "CEP invádo!"
      Peg_CEP = "ERRO"
      Exit Function
   End If

   '
   'Seta o site que provem o serviçde webservice
   '
   webService.mssoapinit ("http://www.byjg.com.br/xmlnuke-php/webservice.php/ws/cep?WSDL")
   '
   'string[] obterCEPAuth(string Logradouro, string Localidade, string UF,Usuario,Senha)
   'Devolve uma lista de CEP àartir de um nome ou parte do nome de um Logradouro. Apenas os 20 primeiros endereç sãretornados. Com o objetivo de se obter uma lista mais precisa possíl, foram acrescentados os parâtros Localidade e UF. Agradecimentos a Paulo Santana pela sugestã  '
   'string obterLogradouro(string CEP)
   'Devolve o nome do Logradouro àartir do CEP fornecido no formato 00000-000 ou 00000000.
   '
   'string obterVersao()
   'Devolve informaçs sobre a versãdo serviçde CEP.
   '

   vaRet = webService.obterLogradouroAuth(x_CEP, CepUser, CepPWD)
    
   If (Mid(UCase(vaRet), 1, 3) = "CEP") Or (Mid(UCase(vaRet), 1, 7) = "USUÁRIO") Then
      MsgBox UCase(vaRet), vbCritical + vbOKOnly
      Peg_CEP = "ERRO"
      Exit Function
   End If
 
   ' Retorna o Array com os dados do endereço
   Peg_CEP = vaRet
  
End Function

Private Sub Peg_Lg(xLogr, xLocal, xUf, CepUser, CepPWD)
   Dim webService As New SoapClient, Retorno As Variant
 
   '
   'Seta o site que provem o serviçde webservice
   '
   webService.mssoapinit ("http://www.byjg.com.br/site/webservice.php/ws/cep?WSDL")

   '
   'string[] obterCEPAuth(string Logradouro, string Localidade, string UF,Usuario,Senha)
   'Devolve uma lista de CEP àartir de um nome ou parte do nome de um Logradouro. Apenas os 20 primeiros endereç sãretornados. Com o objetivo de se obter uma lista mais precisa possíl, foram acrescentados os parâtros Localidade e UF. Agradecimentos a Paulo Santana pela sugestã  '
   'string obterLogradouro(string CEP)
   'Devolve o nome do Logradouro àartir do CEP fornecido no formato 00000-000 ou 00000000.
   '
   'string obterVersao()
   'Devolve informaçs sobre a versãdo serviçde CEP.
   '
   'Retorno = webService.obterLogradouroAuth(txtCEP.Text, Usuario, Senha)
   
   Retorno = webService.obterCEPAuth(xLogr, xLocal, xUf, CepUser, CepPWD)

   '
   'Imprime o retorno da web
   '
   Dim xx As Integer
   
   lstResultado.Clear
   txtEscolha.Text = ""
   
   For xx = 0 To UBound(Retorno)
      lstResultado.AddItem Retorno(xx)
   Next

End Sub
