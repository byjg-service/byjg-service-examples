<%@ Page Title="" Language="C#" MasterPageFile="~/Site.master" AutoEventWireup="true"
    CodeFile="Default.aspx.cs" Inherits="_Default" %>

<asp:Content ID="Content1" ContentPlaceHolderID="HeadContent" runat="Server">
    <style type="text/css">
        .style1
        {
            width: 511px;
        }
    </style>
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="MainContent" runat="Server">
    <fieldset>
        <legend><b>Teste</b></legend>
        <table>
            <tr>
                <td class="style1">
                    DDD:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <asp:TextBox ID="txtddd" runat="server" Width="50px" MaxLength="2" />
                    <asp:RequiredFieldValidator ID="RequiredFieldValidator3" runat="server" ControlToValidate="txtddd"
                        ErrorMessage="DDD Inválido" ForeColor="#FF3300"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td>
                    Número:&nbsp;&nbsp;&nbsp;
                    <asp:TextBox ID="txtNumero" runat="server" Width="150px" MaxLength="8" />
                    <asp:RequiredFieldValidator ID="RequiredFieldValidator1" runat="server" ControlToValidate="txtNumero"
                        ErrorMessage="Número de telefone inválido" ForeColor="#FF3300"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td style="text-align: center" class="style1">
                    <b>Limite de 160 caracteres</b>
                </td>
            </tr>
            <tr>
                <td class="style1">
                    Mensagem:
                    <asp:TextBox ID="txtMensagem" runat="server" Height="100px" TextMode="MultiLine"
                        Width="300px" MaxLength="160" />
                    <asp:RequiredFieldValidator ID="RequiredFieldValidator2" runat="server" ControlToValidate="txtMensagem"
                        ErrorMessage="Valor inválido" ForeColor="#FF3300"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td style="text-align: right" class="style1">
                    <asp:Button Text="Enviar" runat="server" ID="btnEnviar" Width="150px" OnClick="btnEnviar_Click" />
                </td>
            </tr>
            <tr>
                <td style="text-align: center" class="style1">
                    <asp:Label ID="lblRetorno" runat="server" ForeColor="#FF3300"></asp:Label></td>
            </tr>
        </table>
    </fieldset>
</asp:Content>
