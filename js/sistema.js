/*
 * Nome.....: SomenteNumero
 * Objetivo.: So permitir numero em caixa de texto
 * Paramento: e (evento)
 * Retorno..: True  - Se for so Numero
 *            False - Diferente de Numero
 * Autor....: Celio Barros
 * Data.....: 07/08/2018
 * Alteracao:
 */
function SomenteNumero(e){
	var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}

/*
 * Nome.....: LetraNumero
 * Objetivo.: So permitir Letra,Numero e os caracteres especias 'Traco-' 'Espaco em Branco'
 * Paramento: e (evento)
 * Retorno..: True  - Se for Letra,Numero e os caracteres especias 'Traco-' 'Espaco em Branco'
 *            False - Diferente de Letra,Numero e os caracteres especias 'Traco-' 'Espaco em Branco'
 * Autor....: Celio Barros
 * Data.....: 07/08/2018
 * Alteracao:
 */
function LetraNumero(e){
    return true;
    var tecla=(window.event)?event.keyCode:e.which;   
    if( (tecla>47 && tecla<58) || (tecla>64 && tecla<91) || (tecla>96 && tecla<123 ) || (tecla==32) || (tecla==45)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}


/*
 * Nome.....: LetraMaisucula
 * Objetivo.: So permitir Letra Maiscula e os caracteres especias 'Traco-' 'Espaco em Branco'
 * Paramento: e (evento)
 * Retorno..: True  - Se for Letra Maiscula e os caracteres especias 'Traco-' 'Espaco em Branco'
 *            False - Diferente de Letra Maiscula e os caracteres especias 'Traco-' 'Espaco em Branco'
 * Autor....: Celio Barros
 * Data.....: 07/08/2018
 * Alteracao:
 */
function LetraMaiscula(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if(  (tecla>64 && tecla<91) ||  (tecla==32) || (tecla==45)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}

/*
 * Nome.....: ZerosEsquerda
 * Objetivo.: Incluir Zeros a Esquerda
 * Paramento: objControle - nome da tag de INPUT do HTML
 *            intTam      - Tamanho da Variavel
 * Retorno..: Atualiza o valor do input TEXT 
 *            Ex: ZerosEsquera(3,5) Retorno: 00003
 * Autor....: Celio Barros
 * Data.....: 07/08/2018
 * Alteracao:
 */

function ZerosEsquerda(objControle,intTam)
{
	var strCodigo=objControle.value;
	strCodigo="0".repeat(intTam)+strCodigo.trim();
	objControle.value=Right(strCodigo,intTam);
    
}

/*
 * Nome.....: Left
 * Objetivo.: Retornar n caracteres pela esquerada
 * Paramento: strr - Valor 
 *            n    - Numero de caracteres pela esquerda
 * Retorno..: Retornar n caracteres pela esquerada
 * Autor....: Celio Barros
 * Data.....: 07/08/2018
 * Alteracao:
 */
function Left(str, n){
	if (n <= 0)
	    return "";
	else if (n > String(str).length)
	    return str;
	else
	    return String(str).substring(0,n);
}

/*
 * Nome.....: Right
 * Objetivo.: Retornar n caracteres pela Direita
 * Paramento: strr - Valor 
 *            n    - Numero de caracteres pela Direita
 * Retorno..: Retornar n caracteres pela Direita
 * Autor....: Celio Barros
 * Data.....: 07/08/2018
 * Alteracao:
 */
function Right(str, n){
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
}

/*
 * Nome.....: Valida
 * Objetivo.: Validacao de Senha e ContraSenha formulario Autorizado
 * Paramento: Codigo da Operacao
 * Retorno..: Retornar true senha e contra senha iguais
 * Autor....: Celio Barros
 * Data.....: 04/02/2019
 * Alteracao:
 */

function Valida(strStatus)
{
   if ( strStatus!='i') {
       return true;
   }
    var senha=document.getElementById('senha').value;
    var contrasenha=document.getElementById('contrasenha').value;
    
    if ( senha!=contrasenha ) {
        document.getElementById("errorsenha").innerHTML="Senha diferentes!!!";
        document.getElementById("contrasenha").focus();

        return false;
    }
    return true;         
}

/*
 * Nome.....: MostraSenha()
 * Objetivo.: Visualizar a Senha ou Contra Senha
 * Paramento:  
 * Retorno..: Alterar a propriedatde type de text->password e password->text
 * Autor....: Celio Barros
 * Data.....: 04/02/2019
 * Alteracao:
 */

function MostraSenha(strInput)
{
   var novoTipo=document.getElementById(strInput).type=="text"?"password":"text";
   document.getElementById(strInput).setAttribute("type", novoTipo);

}

/*
 * Nome.....: changecomboempresa()
 * Objetivo.: Atualizar combo dependente da Empresa
 * Paramento:  
 * Retorno..: retorna URL com filtro da Empresa
 * Autor....: Celio Barros
 * Data.....: 04/02/2019
 * Alteracao:
 */
function changecomboempresa(filtroEmpresa,opcao)
{
    
    var status= opcao.substr(0, 3)=="cad"?"&status=i":"";
    var filtro= opcao.substr(0, 3)=="cad"?"&codEmp=" :"&filtroEmp=";
    
    window.location.href = "sisarq.php?option="+opcao+filtro+filtroEmpresa+status;
}  

/*
 * Nome.....: changecomboautorizado()
 * Objetivo.: Atualizar combo dependente do Usuario
 * Paramento:  
 * Retorno..: retorna URL com filtro da Empresa
 * Autor....: Celio Barros
 * Data.....: 04/02/2019
 * Alteracao:
 */
function changecomboautorizado(filtroAutorizado,opcao)
 {
     window.location.href = "sisarq.php?option=setorautorizado&filtroAut="+filtroAutorizado;
 
}




/*
 * Nome.....: changecombousuario()
 * Objetivo.: Atualizar combo dependente do Usuario
 * Paramento:  
 * Retorno..: retorna URL com filtro da Empresa
 * Autor....: Celio Barros
 * Data.....: 04/02/2019
 * Alteracao:
 */
function changecombousuario(filtroUsuario,opcao)
 {
    alert("usuario");
    if ( opcao=="acesso" )
    {
        window.location.href = "sisarq.php?option=acesso&filtroUsu="+filtroUsuario;
    } 
    if ( opcao=="cadacesso" )
    {
        window.location.href = "sisarq.php?option=cadacesso&codUsu="+filtroUsuario+"&status=i";
    } 
      
 
}






