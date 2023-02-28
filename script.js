
$(document).ready(function(){
    // Add smooth scrolling to all links
    $("a").on('click', function(event) {
  
      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();
  
        // Store hash
        var hash = this.hash;
  
        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800, function(){
  
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      } // End if
    });
  });
  
  // CEP
  function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('rua').value=("");
    document.getElementById('bairro').value=("");
    document.getElementById('cidade').value=("");
    document.getElementById('uf').value=("");
  }
  
  function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById('rua').value=(conteudo.logradouro);
    document.getElementById('bairro').value=(conteudo.bairro);
    document.getElementById('cidade').value=(conteudo.localidade);
    document.getElementById('uf').value=(conteudo.uf);
  } //end if.
  else {
    //CEP não Encontrado.
    limpa_formulário_cep();
    alert("CEP não encontrado.");
  }
  }
  
  function pesquisacep(valor) {
  
  //Nova variável "cep" somente com dígitos.
  var cep = valor.replace(/\D/g, '');
  
  //Verifica se campo cep possui valor informado.
  if (cep != "") {
  
    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;
  
    //Valida o formato do CEP.
    if(validacep.test(cep)) {
  
        //Preenche os campos com "..." enquanto consulta webservice.
        document.getElementById('rua').value="...";
        document.getElementById('bairro').value="...";
        document.getElementById('cidade').value="...";
        document.getElementById('uf').value="...";
  
        //Cria um elemento javascript.
        var script = document.createElement('script');
  
        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
  
        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);
  
    } //end if.
    else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
    }
  } //end if.
  else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
  }
  };


  /********************************************************
     COOKIE → Verifica se o cookie sobre cookies existe..
  ********************************************************/ 
 
  if (getCookie('cookieAccept') != '') {

    // COOKIE → Se existe, oculta mensagem de cookie:
    $('#acCookies').hide();

    // COOKIE → Se não...
  } else {

    // COOKIE → Se não existe, mostra a mensagem de cookie:
    $('#acCookies').show();
  }

  // COOKIE → Monitora clique no botão de aceitar cookies:
  $(document).on('click', '#accept', function () {

    // COOKIE → Cria o cookie aceitando a mesagem sobre cookies:
    setCookie('cookieAccept', 'accept', 365);

    // COOKIE → Ocultar a mensagem de cookie:
    $('#acCookies').hide();
  });


  /*****************************
     setCookie() → Cria cookies:
 ********************************/

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

}

/*****************************************
  getCookie() → Lê o valor de um cookie:
 *****************************************/

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
  