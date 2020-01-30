<?php
    
  

    
    $project_name = "/sisarqphpv2/";

    $project_index = "http://".$_SERVER['SERVER_NAME'].$project_name;
	
	# Url do caminho do servidor na raiz
	$project_path = $_SERVER['DOCUMENT_ROOT'].$project_name;

    echo $project_name."<br>";


    echo $project_index."<br>";
    echo $project_path."<br>";
    
 /*   
    
    # Incluindo os arquivos Necessários
    include_once 'dao/menuPDO.php';



    #--> Montando o Menu do Sistema
    $menuPDO= new MenuPDO();
    $menu=$menuPDO->lista($user['id_usu']);

    $submenu=false;//Variavel de Submenu
    
    while($opcao = $menu->fetch())
        
        $item=substr($opcao['seq_menu'],0,2]
        # Verificar se e SubMenu
        if ($opcao['tipo_menu']=='1')
        {
            $menuHtml.= '<li class="">';
            $menuHtml.= '   <a href="?option='. $opcao['href_menu'].'">';
            $menuHtml.= '     <i class="' .$opcao['icone_menu'].'"></i> ';
            $menuHtml.= '     <span>' .$opcao['nome_menu'] .'</span>';
            $menuHtml.= '   </a>';
            $menuHtml.= '</li>';
        }
        else
        {
            $menuHtml.='<li class="has-sub">';
 
        }
        while($opcao = $menu->fetch() && $item=substr($opcao['seq_menu'],0,2])
        {
            
            if ($opcao['tipo_menu']=='0')
            {
                $menuHtml.='<a href="#">';
                $menuHtml.='  <i class="'.$opcao['icone_menu'].'"></i> '; 
                $menuHtml.='  <span>' .$opcao['nome_menu'] .'</span>';
                $menuHtml.='  <span class="pull-right-container">'
                $menuHtml.='     <i class="fa fa-angle-left pull-right"></i>'; 
                $menuHtml.='  </span>';
                $menuHtml.='</a>';
                $menuHtml.=<ul class="sub-menu">
                $submenu=true;
            }
            else
            {

                $menuHtml.='<li>';
                $menuHtml.='   <a href="?option='. $opcao['href_menu'].'">';
                $menuHtml.='     <i class="' .$opcao['icone_menu'].'"></i> ';
                $menuHtml.=      $opcao['nome_menu'];
                $menuHtml.='   </a>';
                $menuHtml.='</li>';
             

            }
            if ($submenu)
            {
                $menuHtml.='</ul>';
                $menuHtml.='</li>';
              
            }

        }

    }
*/
          
?>
