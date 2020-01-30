<?php
    
  
 
    # Incluindo os arquivos Necessários

    # Exibicão de erros
	ini_set("display_errors", 1);
	error_reporting(E_ALL | E_WARNING);
	
	# Rotas 

	# Nome do Projeto
	$project_name = "/sisarqphpv2/";

	# Url do Caminho do servidor na rede
	$project_index = "http://".$_SERVER['SERVER_NAME'].$project_name;
	
	# Url do caminho do servidor na raiz
	$project_path = $_SERVER['DOCUMENT_ROOT'].$project_name;

	# ROTAS GLOBAIS
	$GLOBALS['project_index'] = $project_index;
	$GLOBALS['project_path'] = $project_path;
    
    include_once 'dao/menuPDO.php';



    #--> Montando o Menu do Sistema
    $menuPDO= new MenuPDO();
    $menu=$menuPDO->lista(1);

    $submenu=false;//Variavel de Submenu

    $indice =0;
    #echo "<pre>";
    #var_dump($menu);
    #echo "</pre>";
    

    $menuHtml="";
    
    while( $indice<count($menu) )
    {    
        $item=substr($menu[$indice]['seq_menu'],0,2);
        # Verificar se e SubMenu
        if ($menu[$indice]['tipo_menu']=='1')
        {
            $menuHtml.= '<li class="">';
            $menuHtml.= '   <a href="?option='. $menu[$indice]['href_menu'].'">';
            $menuHtml.= '     <i class="' .$menu[$indice]['icone_menu'].'"></i> ';
            $menuHtml.= '     <span>' .$menu[$indice]['nome_menu'] .'</span>';
            $menuHtml.= '   </a>';
            $menuHtml.= '</li>';
            $indice++;
        }
        else
        {
            $menuHtml.='<li class="has-sub">';
 
            while( $indice<count($menu) && $item==substr($menu[$indice]['seq_menu'],0,2) )
            {
                
                if ($menu[$indice]['tipo_menu']=='0')
                {
                    $menuHtml.='<a href="#">';
                    $menuHtml.='  <i class="'.$menu[$indice]['icone_menu'].'"></i> '; 
                    $menuHtml.='  <span>' .$menu[$indice]['nome_menu'] .'</span>';
                    $menuHtml.='  <span class="pull-right-container">';
                    $menuHtml.='     <i class="fa fa-angle-left pull-right"></i>'; 
                    $menuHtml.='  </span>';
                    $menuHtml.='</a>';
                    $menuHtml.='<ul class="sub-menu">';
                }
                else
                {

                    $menuHtml.='<li>';
                    $menuHtml.='   <a href="?option='. $menu[$indice]['href_menu'].'">';
                    $menuHtml.='     <i class="' .$menu[$indice]['icone_menu'].'"></i> ';
                    $menuHtml.=      $menu[$indice]['nome_menu'];
                    $menuHtml.='   </a>';
                    $menuHtml.='</li>';

                }
                $indice++;
            }

            $menuHtml.='</ul>';
            $menuHtml.='</li>';
        }

    }
      
    echo $menuHtml;
    ?>
