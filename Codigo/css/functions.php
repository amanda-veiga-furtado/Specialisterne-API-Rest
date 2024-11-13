<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Símbolos -->
            <script src="https://kit.fontawesome.com/9572f9bae9.js" crossorigin="anonymous"></script>

        <!-- Impedir Digitaçao de caracteres especiais -->
            <script src="../css/script_defer.js" defer></script>
        
        <!-- Campo Select Pesquisar Digitando -->
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <style>
        /*containers*/
        <?php
            // Função Mudar Imagem Aleatóriamente
                $images = range(start: 1,end: 32); // Array com o nome das imagens
                $randomImage = $images[array_rand($images)]; // Seleciona uma imagem aleatória    
        ?>
        .container_background_image_small {
            width: 100vw;
            height: 70.6vh; 
            /* 85,3 */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: none;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .container_background_image_medium {
            width: 100vw;
            height: 85.3vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: none;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .container_background_image_grow {
            width: 100%;
            /* height: 85.3vh; */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: none;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .container_background_image_grow_2 {
            width: 100%;
            /* height: 85.3vh; */
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('../../css/img/fundo/<?php echo $randomImage; ?>.jpg')no-repeat center center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .container_whitecard_small {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 710px;
            height: 343px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 25px 30px 55px #5557;
            border-radius: 13px;
            overflow: hidden;
            margin-top: 8.45vh; 
            margin-bottom: 8.45vh; /* Cartão Branco no meio da pagina */
        }
        .container_whitecard_grow {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 710px;
            min-height: 410px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 25px 30px 55px #5557;
            border-radius: 13px;
            overflow: hidden;
            margin-top: 8.45vh;
            margin-bottom: 8.45vh;
        }
        .container_form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 96%;
            height: 93.5%;
            /* background-color: #30B5C2; */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 1.9vh; 
            /* margin-bottom: 1vh; */
        }
        /* Titulo */
        .form-title-big {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            margin-top: 25px;
            width: 100%;
            position: relative;
        } 
        .form-toggle button,
        .form-title-big button {
            background: none;
            border: none;
            /* font-size: 20px; */
            font-size: 22px;
            cursor: pointer;
            padding: 10px 20px;
            color: #888;
            transition: color 0.3s;
            flex-grow: 1;
            text-align: center;
        }
        .form-title-big button {
                font-size: 32px;
        }
        .form-toggle button:hover,
        .form-title-big button:hover,
        .form-toggle button:focus,
        .form-title-big button:focus {
            color: #333;
        }
        .toggle-line-big {
            position: absolute;
            bottom: -5px;
            left: 100%;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--vermelho-primario), var(--laranja-primario), var(--amarelo-primario), var(--verde-primario), var(--azul-primario), var(--roxo-primario)); /* Gradiente arco-íris */
            transition: transform 0.3s;
            transform: translateX(-100%); /* Centraliza horizontalmente */
        }
        .toggle-line-small {
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50%;
            height: 3px;
            background: linear-gradient(90deg, var(--vermelho-primario), var(--laranja-primario), var(--amarelo-primario), var(--verde-primario), var(--azul-primario), var(--roxo-primario)); /* Gradiente arco-íris */
            transition: transform 0.3s;
            }

            /* Cards */
            .projcard {
                position: relative;
                width: 90%;
                height: 220px;
                margin-bottom: 30px;
                border-radius: 10px;
                background-color: white;
                border: 2px solid #ddd;
                font-size: 18px;
                overflow: hidden;
                cursor: pointer;
                box-shadow: 0 4px 21px -12px rgba(0, 0, 0, .66);
                transition: box-shadow 0.2s ease, transform 0.2s ease;
            }
            .projcard-small {
                position: relative;
                width: 90%;
                height: 160px;
                margin-bottom: 30px;
                border-radius: 10px;
                background-color: white;
                border: 2px solid #ddd;
                font-size: 18px;
                overflow: hidden;
                cursor: pointer;
                box-shadow: 0 4px 21px -12px rgba(0, 0, 0, .66);
                transition: box-shadow 0.2s ease, transform 0.2s ease;
                align-items: center;
                align-content: center;
                justify-content: center; /* centraliza os itens horizontalmente */

                    }
            .projcard:hover,
            .projcard-small:hover{
                box-shadow: 0 34px 32px -33px rgba(0, 0, 0, .18);
                transform: translate(0px, -3px);
            }









            * {
                padding: 0; /* Remove o padding padrão de todos os elementos */
                margin: 0; /* Remove a margem padrão de todos os elementos */
                box-sizing: border-box; /* Inclui padding e border na largura e altura total dos elementos */
            }
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            /* Paleta de Cores______________________________________________________*/
                :root {
                    --vermelho-primario:    #fe797b;        --vermelho-secundario:  #FC445D;
                    --laranja-primario:     #ffb750;        --laranja-secundario:   #f39c12;
                    --amarelo-primario:     #ffea56;        --amarelo-secundario:   #f1c40f;
                    --verde-primario:       #8fe968;        --verde-secundario:     #7BDB47;
                    --azul-primario:        #36cedc;        --azul-secundario:      #30B5C2;
                    --roxo-primario:        #a587ca;        --roxo-secundario:      #8c6db6;
                    --cinza-primario:       #f9f9f9;        --cinza-secundario:     #8f8f8f; 
                    /* //#5E5E5E */
                    /* #FE8FAA */
                }
            /*menu.php______________________________________________________________*/
                nav {
                    display: flex; /* Usa flexbox para alinhar conteúdo verticalmente */
                    flex-direction: column; /* Coluna principal */
                    justify-content: center; /* Centraliza verticalmente */
                    align-items: center; /* Centraliza horizontalmente */
                    position: relative; /* Define a posição relativa para o body */
                    font-family: Hack, monospace; /* Define a fonte para todo o documento */
                    width: 100%; /* Faz a navbar preencher toda a largura da tela */
                    margin: 0px; /* Margem zero para remover espaçamento padrão */
                    background: var(--cinza-primario); /* Cor de fundo da barra de navegação */
                    padding: 0px; /* Padding zero para remover espaçamento interno */
                }
                .menuItems {
                    list-style: none; /* Remove marcadores de lista */
                    display: flex; /* Usa flexbox para alinhar itens da lista */
                    justify-content: center; /* Centraliza horizontalmente os itens da lista */
                }
                .menuItems li {
                    display: flex; /* Adiciona flexbox ao li */
                    align-items: center; /* Centraliza verticalmente os itens */
                    margin: 30px; /* Margem entre os itens da lista */
                    position: relative; /* Define a posição relativa para os itens da lista */
                    text-align: center;
                }
                .menuItems a {
                    text-decoration: none; /* Remove sublinhado dos links */
                    color: var(--cinza-secundario); /* Cor do texto dos links */
                    font-size: 24px; /* Tamanho da fonte dos links */
                    font-weight: 400; /* Peso normal da fonte */
                    text-transform: uppercase; /* Transforma o texto em maiúsculas */
                    position: relative; /* Define a posição relativa para os links */
                }
                .menuItems a::before {
                    content: ''; /* Conteúdo vazio para o pseudoelemento ::before */
                    position: absolute; /* Posição absoluta para o pseudoelemento */
                    width: 100%; /* Largura total */
                    height: 3px; /* Altura do traço arco-íris */
                    bottom: -6px; /* Posicionamento abaixo do texto */
                    background: linear-gradient(90deg, var(--vermelho-primario), var(--laranja-primario), var(--amarelo-primario), var(--verde-primario), var(--azul-primario), var(--roxo-primario)); /* Gradiente arco-íris */
                    visibility: hidden; /* Inicia invisível */
                    transform: scaleX(0); /* Inicia sem largura (escala zero) */
                    transition: transform 0.3s ease, visibility 0s linear 0.3s; /* Transição suave */
                }
                .menuItems a:hover::before {
                    visibility: visible; /* Torna o traço visível ao passar o mouse */
                    transform: scaleX(1); /* Expande o traço para a largura total do link */
                    transition: transform 0.3s ease, visibility 0s linear; /* Transição suave */
                }
            /*Input_________________________________________________________________*/
                .container_form input[type="text"], 
                .container_form input[type="tel"], 

                .container_form input[type="email"], 
                .container_form input[type="password"],
                .container_form input[type="number"],
                .container_form textarea, 
                .container_form select {
                    margin-bottom: 17px;
                    padding: 12px; /* Espaçamento interno */
                    border: 1px solid rgba(143, 143, 143, 0.5);
                    border-radius: 8px;
                    font-size: 16px;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    width: 100%;
                    box-sizing: border-box;
                    height: 46px;
                    background-color: white;
                    color: var(--cinza-secundario); 
                    transition: border-color 0.3s, box-shadow 0.3s; /* Transição suave */
                }
                .container_form textarea{
                    height: 460px;
                }
                input[type="file"] {
                margin-bottom: 15px;
                border: 1px solid rgba(143, 143, 143, 0.5);
                border-radius: 8px;
                height: 46px; 
                padding: 0; 
                font-size: 16px;
                box-sizing: border-box;
                width: 100%;
                }
                /* Botão do file input*/
                input[type="file"]::file-selector-button {
                    background-color: #36cedc;
                    border: none;
                    border-radius: 8px;
                    color: white;
                    padding: 10px;
                    cursor: pointer;
                    height: 100%; /* Ensures the button fills the input height */
                }
                input[type="file"]::file-selector-button:hover {
                    background-color: #30B5C2;
                }
                input[type="text"]:focus,
                .container_form input[type="email"]:focus, 
                .container_form input[type="password"]:focus,
                textarea:focus, select:focus,
                input[type="file"]:focus {
                    border-color: var(--azul-primario);
                    outline: none;
                }
            
                /*Estilo do Select2_________________________________________________________________*/
                   /* Para garantir que a largura do Select2 seja sempre 100% */
                    .select2-container {
                        width: 100% !important; /* Força a largura total */
                    }
                    .select2-selection--single {
                        height: 46px !important; /* Altura consistente */
                        width: 100% !important; /* Altura consistente */
                        padding: 12 0px !important; /* Padding igual aos inputs */
                        display: flex;
                        align-items: center; /* Alinha verticalmente */
                        border-radius: 8px !important;
                        border: 1px solid rgba(143, 143, 143, 0.5)!important;
                        font-size: 16px;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        box-sizing: border-box;
                        background-color: white;
                        color: var(--cinza-secundario) !important;
                        transition: border-color 0.3s, box-shadow 0.3s;
                    }
                    .select2-selection--single:focus,
                    .select2-container--default .select2-selection--single:focus {
                        border-color: var(--azul-primario);
                        outline: none;   
                    }
                    /* Ajuste do padding do conteúdo renderizado no Select2 */
                    .select2-container--default .select2-selection--single .select2-selection__rendered {
                        padding-left: 12px !important; /* Mesmo padding dos inputs */
                        line-height: 46px !important; /* Alinhamento vertical */
                        color: rgba(143, 143, 143, 0.5) !important;
                    }
                    .select2-container--default .select2-selection--single .select2-selection__arrow {
                        height: 46px !important;
                        top: 50%;
                        transform: translateY(-50%);
                        color: var(--cinza-secundario) ;
                        border: 1px solid rgba(143, 143, 143, 0.5)!important;
                        border-radius: 8px;
                    }
                    /* Estilo da caixa de pesquisa dentro do dropdown do Select2 */
                    .select2-container .select2-search--dropdown .select2-search__field {
                        width: 100%;
                        height: 40px;
                        padding: 12px;
                        border-radius: 8px !important; /* Corrigindo as bordas arredondadas */
                        border: 1px solid rgba(143, 143, 143, 0.5);
                        font-size: 16px;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background-color: white;
                        color: var(--cinza-secundario);
                        box-sizing: border-box;
                    }
                    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
                        border-color: var(--azul-primario); /* Borda azul ao focar */
                        outline: none;
                    }
                    /* Outros estilos do Select2 */
                    .select2-dropdown {
                        border-radius: 8px;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        color: rgba(143, 143, 143, 0.5) !important;

                    }
                    /* Estilo para a primeira opção selecionada */
                    .select2-results__option[aria-selected="true"],
                    .select2-results__option--highlighted[aria-selected="true"] {
                        background-color: var(--azul-primario) !important;
                        color: white !important;
                    }
                    .select2-results__option {
                        font-size: 16px;
                        color: rgba(143, 143, 143, 0.5) !important;
                        padding: 8px; /* Adiciona um pouco de padding nas opções */
                    }
                    .select2-results__option:hover {
                        background-color: var(--azul-primario) !important;
                        color: white !important;
                    }
                    /* Quando a opção está destacada (focada) */
                    .select2-results__option--highlighted {
                        background-color: var(--azul-primario);
                        color: white;
                    }
                    /* Ajuste do padding no Select2 */
                    .select2-selection__rendered {
                        padding-left: 12px !important; /* Ajuste do padding para alinhar com outros inputs */
                        font-size: 16px;
                        height: 46px;
                        color: rgba(143, 143, 143, 0.5) !important;
                    }
                    .js-example-basic-single {
                        margin-bottom: 17px;
                        padding: 12px !important;
                        border: 1px solid rgba(143, 143, 143, 0.5);
                        border-radius: 8px;
                        font-size: 16px;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        width: 100%;
                        box-sizing: border-box;
                        height: 46px; 
                        background-color: white; 
                        color: var(--cinza-secundario); 
                        transition: background-color 0.3s, border-color 0.3s; /* Transição suave */
                    } 
                    /* Estilo para o campo de pesquisa e select customizado */
                    #search-input,
                    #ingredient-select {
                        margin-bottom: 10px;
                        padding: 12px;
                        width: 100%;
                        font-size: 16px;
                        border: 1px solid rgba(143, 143, 143, 0.5) !important;
                        border-radius: 15px !important;
                        background-color: white;
                        color: rgba(143, 143, 143, 0.5) !important;
                        transition: border-color 0.3s;
                    }
                    /* Comportamento ao focar o campo customizado */
                    #search-input:focus, #ingredient-select:focus {
                        border-color: var(--azul-primario) !important;
                    }      
            /* Div__________________________________________________________________*/

                /*Cartão Branco__________________________________________________________________________*/

            /* Botões__________________________________________________________________*/

            .button-yellow {
                background-color: var(--amarelo-primario);              
                padding: 12px;
                border: none;
                border-radius: 8px;
                color: white;
                font-size: 18px;
                cursor: pointer;
                transition: background-color 0.3s;
                width: 100%; 
                justify-content: center; /* Centraliza horizontalmente */
                align-items: center; /* Centraliza verticalmente */
                text-align: center;
            }
            .button-yellow:hover {
                background-color: var(--amarelo-secundario);
            }
            .button-red {
                /* padding: 12px; */
                border: none;
                border-radius: 8px;
               
                cursor: pointer;
                transition: background-color 0.3s;

            }
            .button-red:hover {
            }

            .button-orange {
                background-color: var(--laranja-primario);              
                padding: 12px;
                border: none;
                border-radius: 8px;
                color: white;
                font-size: 18px;
                cursor: pointer;
                transition: background-color 0.3s;
                width: 100%; 
                justify-content: center; /* Centraliza horizontalmente */
                align-items: center; /* Centraliza verticalmente */
                text-align: center;
            }
            .button-orange:hover {
                background-color: var(--laranja-secundario);
            }


                .container-button-long {
                    position: absolute;
                    bottom: 0;
                    width: 100%;
                    background-color: white;
                    color: black;
                    text-align: center;
                }
                .button-long {
                    background-color: var(--roxo-primario);
                    color: white;
                    border: none;
                    border-radius: 8px;
                    padding: 12px;
                    font-size: 18px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                    width: 100%;
                    justify-content: center;
                    align-items: center; 
                    text-align: center;
                }
                .button-long:hover, .button-short:hover {
                    background-color: #8c6db6; 
                }


















            .whitecard_form_type_1 {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                position: relative;
                background: white;
                padding: 30px;
                border-radius: 12px;
                width: 710px;
                height: 410px;
                display: flex;
                flex-direction: column;
                align-items: center;
                box-shadow: 25px 30px 55px #5557;
                border-radius: 13px;
                overflow: hidden;
                margin-top: 8.45vh; 
                margin-bottom: 8.45vh; /* Cartão Branco no meio da pagina */
            }

















/* Carrinho */
.cart-close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: var(--vermelho-primario); /* Cor inicial do ícone */
    cursor: pointer;
    z-index: 10;
}

.cart-close:hover,
.cart-close:focus {
    color: var(--vermelho-secundario); /* Vinho no hover e focus */
}

.cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
}























        /*Div____________________________________________________________________________________________*/
            /*Imagem de Fundo____________________________________________________________________________*/


            




            /*  Container Formulario_____________________________________________________________________*/


        /*Texto___________________________________________________________________________________________*/
            /*Titulo_____________________________________________________________________________________*/



            .projcard-bar {
                left: -2px;
                width: 100%;
                height: 3px;
                margin: 10px 0;
                border-radius: 5px;
                background: linear-gradient(90deg, var(--vermelho-primario), var(--laranja-primario), var(--amarelo-primario), var(--verde-primario), var(--azul-primario), var(--roxo-primario)); /* Gradiente arco-íris */
                transition: transform 0.3s;
            }
        /* Botões___________________________________________________________________________________ */
            .button-search{
                padding: 12px !important;
                border: none;
                border-radius: 8px;
                background-color: #36cedc;
                color: white;
                font-size: 18px;
                cursor: pointer;
                transition: background-color 0.3s;
                width: 10%;    
                height: 40px;
                justify-content: center; /* centraliza os itens horizontalmente */
                align-items: center; /* centraliza os itens verticalmente */
                text-align: center;
            }
            .button-search:hover{
                background-color: #30B5C2;
            } 
    
            /* Link______________________________________________________________________________________*/
                .div_link{
                    margin-top: 0.1cm;
                    text-align: center;
                }
                a {
                    color: #8c6db6;
                    text-decoration: none;
                }
                a.forgot {
                    padding-bottom: 3px;
                    border-bottom: 2px solid #a587ca;
                }


















            .form_switch {
                position: relative;
                width: 100%;
                height: 100%; 
                /* background-color: black; */
                /* margin-top: 0.5vh;
                margin-bottom: 5vh; */
            }
            .form-toggle {
                display: flex; 
                justify-content: space-between;
                margin-bottom: 28px;
                width: 100%;
                position: relative;
                /* background-color: red; */
            }

        /* Botão___________________________________________________________________________________*/



        
        /* Outros________________________________________________________________________________________*/
            /* Linha Colorida____________________________________________________________________________*/




        /* Texto_________________________________________________________________________________________*/
            .container_form h1, 
            .h1 {
                color: #333;
                font-size: 28px;
                margin-top: 19px;
                margin-bottom: 1px;
            } 
            .container_form h2,
            .h2 {
                margin-bottom: 15px;
                color: #333;
                font-size: 24px;
                margin-top: 15px;
            }
            .container_form h3,
            .h3 {
                margin-bottom: 10px;
                color: #333;
                font-size: 20px;
            }
            .container_form p,
            .p {
                margin: 5px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 15pt;
                font-weight: bold;
                /* background-color: gray; */
                color: white;
            }
            .container_form hr,
            hr {
                border: none; /* Remove a borda padrão */
                height: 1px; /* Define a altura da linha */
            /*background: linear-gradient(90deg, var(--vermelho-primario), var(--laranja-primario), var(--amarelo-primario), var(--verde-primario), var(--azul-primario), var(--roxo-primario));   */
                background-color: (54, 206, 220, 0.5);                      
            }



        /* Botões________________________________________________________________________________________*/
            .container-buttons {
                display: flex;
                gap: 100px; /* Distância entre os botões */
            }




            .button-short{
                padding: 12px;
                border: none;
                border-radius: 8px;
                background-color: #a587ca;
                color: white;
                font-size: 18px;
                cursor: pointer;
                transition: background-color 0.3s;
                /* width: 34%;     */
                width: 100px;
                justify-content: center; /* centraliza os itens horizontalmente */
                align-items: center; /* centraliza os itens verticalmente */
                text-align: center;
            }


     

            
            /* Botões + e - _____________________________________________________________________________*/

                .button-round {
                border: none;
                color: white;
                padding: 0; /* Remova o padding para usar flexbox */
                text-align: center;
                text-decoration: none;
                display: inline-block;
                /*display: flex;*/
                justify-content: center; /* Centraliza horizontalmente */
                align-items: center; /* Centraliza verticalmente */
                font-size: 20px;
                margin: 4px 2px;
                cursor: pointer;
                height: 40px;
                width: 40px;
                border-radius: 50%;
                    }
                    .button-plus {
                        background-color: #8fe968;
                    }
                    .button-plus:hover {
                        background-color: #7BDB47;
                    }
                    .button-minus {
                        background-color: #fe797b;
                    }
                    .button-minus:hover {
                        background-color: #FC445D;
                    }

        /* Paginação_____________________________________________________________________________________*/
            .div_pagination {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                /* background-color: #f9f9f9; */
                display: flex;
                justify-content: center;
                align-items: center;
                height: 10vh;
            }
                .pagination {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        gap: 10px;
                        padding: 10px;
                }
                    .pagination a {
                        color: white;
                        background-color: #a587ca;
                        opacity: 0.7;
                        border-radius: 25px;
                        padding: 8px 16px;
                        margin: 0 5px;
                        text-decoration: none;
                        font-size: 14px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra leve para um toque delicado */
                        transition: all 0.3s ease;
                        width: 40px;

                    }
                    .pagination a:hover {
                        background-color: #8c6db6; 
                        transform: translateY(-2px); /* Efeito de leve elevação */
                    }

                    .pagination a.active {
                        background-color: #36cedc; /* Azul Primário */
                        color: white;
                    }

                    .pagination a:first-child,.pagination a:last-child {
                        font-size: 16px;
                        padding: 8px 12px;
                        width: 90px;
                    }
            .projcard-container {
                margin: 15px 0; /*Margem vertical*/
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .projcard-container,
            .projcard-container * {
                box-sizing: border-box;
            }
            .projcard-container {
                margin-left: auto;
                margin-right: auto;
                width: 90%;
            }

            .projcard::before {
                content: "";
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                /* background-image: linear-gradient(-70deg, #424242, transparent 50%); */
                opacity: 0.07;
            }
            .projcard-innerbox {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
            }
            .projcard-img {
                position: absolute;
                height: 100%;
                width: 40%; /* Define que a imagem ocupará 40% do cartão */
                top: 0;
                left: 0;
                transition: transform 0.2s ease;
            }
            .projcard:nth-child(2n) .projcard-img {
                left: initial;
                right: 0;
            }
            .projcard-textbox {
                position: absolute;
                top: 7%;
                bottom: 7%;
                left: calc(40% + 30px); /* Ajusta a posição do texto para após a imagem */
                width: calc(60% - 30px); /* Define que o texto ocupará 60% */
                font-size: 17px;
                padding-right: 30px; /* Adicionando espaço à direita */   
            }
            .projcard:nth-child(2n) .projcard-textbox {
                left: 0; /* Alinha o texto à esquerda */
                right: calc(60% + 30px); /* Mantém o texto dentro do cartão */
                padding-left: 30px; /* Adiciona espaço à esquerda */
            }
            .projcard-textbox::before,
            .projcard-textbox::after {
                content: "";
                position: absolute;
                display: block;
                background: #ff0000bb;
                background: white;
                top: -20%;
                left: -55px;
                height: 140%;
                width: 60px;
                transform: rotate(8deg);
            }
            .projcard:nth-child(2n) .projcard-textbox::before {
                display: none;
            }
            .projcard-textbox::after {
                display: none;
                left: initial;
                right: -55px;
            }
            .projcard:nth-child(2n) .projcard-textbox::after {
                display: block;
            }
            .projcard-textbox * {
                position: relative;
            }
            .projcard-title {
                font-size: 24px;
            }
            .projcard-subtitle {
                color: #888;
            }
            .projcard-subtitle-2 {
                color: #888;
                font-size: x-large;
                font-size: 24px;
            }


            .projcard-description,
            projcard-description:nth-child(2n){
                z-index: 10;
                font-size: 16px;
                color: #888;
                height: 125px;
                overflow: hidden;
                text-overflow: ellipsis;
                text-align: justify;
                text-justify: inter-word;
            }
            .projcard-tagbox {
                position: absolute;
                bottom: 3%;
                font-size: 14px;
                cursor: default;
                user-select: none;
                pointer-events: none;
            }
            .projcard-tag {
                display: inline-block;
                background: #F2F2F2;
                color: #777;
                border-radius: 3px 0 0 3px;
                line-height: 26px;
                /* padding: 0 10px 0 23px; */
                padding: 0 5px 0 10px;

                position: relative;
                margin-right: 20px;
                cursor: default;
                user-select: none;
                transition: color 0.2s;
            }
            /* .projcard-tag::before {
                content: '';
                position: absolute;
                background: white;
                border-radius: 10px;
                box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
                height: 6px;
                left: 10px;
                width: 6px;
                top: 10px;
            } */
            .projcard-tag::after {
                content: '';
                position: absolute;
                border-bottom: 13px solid transparent;
                border-left: 10px solid #F2F2F2;
                border-top: 13px solid transparent;
                right: -10px;
                top: 0;
            }



                    
        /* Formulários___________________________________________________________________________________*/




        /* Linha Colorida */


                  /* Imagens__________________________________________________*/
                  .lista-receita-imagem {
                                    /* background-position: center; */
                                    justify-content: center; /* centraliza os itens horizontalmente */
                                    align-items: center; /* centraliza os itens verticalmente */
                                    /* background-size: cover; */
                                    /* width: 100%; */
                                    width: 5%;
                                }
                                .banner {
                                    /* background-image: url(../css/img/receita/imagem.png); */
                                    background-position: center;
                                    background-size: cover;
                                    height: 300px;
                                }
        </style>
    </head>
    <body>   
        <script>
            // login.php (css)
                function showLogin() {
                    document.getElementById('loginForm').style.display = 'block'; // Mostra o formulário de login -->
                    document.getElementById('signupForm').style.display = 'none'; // Esconde o formulário de cadastro 
                    document.getElementById('toggleLine').style.transform = 'translateX(0)'; // Move a linha indicadora para a posição do login
                }

                function showSignup() {
                    document.getElementById('loginForm').style.display = 'none'; // Esconde o formulário de login -->
                    document.getElementById('signupForm').style.display = 'block'; // Mostra o formulário de cadastro 
                    document.getElementById('toggleLine').style.transform = 'translateX(100%)'; // Move a linha indicadora para a posição do cadastro
                }
        </script>
    </body>
</html>