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
                    CEP:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <asp:TextBox ID="txtCep" runat="server" Width="150px" MaxLength="8" />
                    <asp:RequiredFieldValidator ID="RequiredFieldValidator3" runat="server" ControlToValidate="txtCep"
                        ErrorMessage="CEP Inválido" ForeColor="#FF3300"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td style="text-align: right" class="style1">
                    <asp:Button Text="Obter Logradouro" runat="server" ID="btnLogradouro" Width="150px" OnClick="btnLogradouro_Click" />
                </td>
            </tr>
            <tr>
                <td style="text-align: center" class="style1">
                    <asp:Label ID="lblRetorno" runat="server" ForeColor="#FF3300"></asp:Label></td>
            </tr>
        </table>
    </fieldset>
</asp:Content>
