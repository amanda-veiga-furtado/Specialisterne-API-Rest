// RFN003 - Os campos de texto, com exceção dos de e-mail e senha, não aceitarão caracteres como , /, @, <, >, #, $, %, &, *, {, }, [ e ]

  var inputs = document.querySelectorAll('input[type="text"], textarea');

  inputs.forEach(function(input) {
      input.addEventListener("keypress", function(e) {
          if (!checkChar(e)) {
              e.preventDefault();
          }
      });
  });

  function checkChar(e) {
      var char = e.key; // Use e.key para capturar a tecla pressionada corretamente

      console.log(char);

      // Expressão regular que permite letras, números e caracteres especiais aceitos
      var pattern = /^[a-zA-Z0-9çÇ^~´ªºãõáéíóúâêîôûàèìòù]$/;
      
      // Verifica se o caractere é um espaço ou corresponde ao padrão
      if (char === ' ' || char.match(pattern)) {
          return true;
      }

      return false; // Impede caracteres não permitidos
  }
