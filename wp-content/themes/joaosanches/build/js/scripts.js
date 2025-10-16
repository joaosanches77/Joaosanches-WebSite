/*! Theme Script
 * https://lavva.agency/ */
jQuery(document).ready(function ($) {
  console.log("=== VERSION 001 ===");

  var screenWidth = window.innerWidth;
  if ($("#screensize").length) {
    $("#screensize").text(screenWidth);
  }

  ///////////////////////////////////
  // TOGGLE MENU (VERSÃO ATUALIZADA)
  ///////////////////////////////////
  $("#toggle-menu").on("click", function (ev) {
    ev.preventDefault();
    // Adiciona/remove a classe no contentor <nav> principal
    $("#main-nav").toggleClass("mobile-menu-is-open");
    // Controla o scroll da página
    $("body").toggleClass("overflow-hidden");
  });

  ///////////////////////////////////
  // FIX MENU AFTER SCROLL
  ///////////////////////////////////
  const headerElement = $("#header");
  function fixedHeader() {
    if (headerElement) {
      if ($(window).scrollTop() > 200) headerElement.addClass("scrolled");
      else headerElement.removeClass("scrolled");
    }
  }
  fixedHeader();
  $(window).on("scroll", fixedHeader);

  ///////////////////////////////////
  // TOGGLE COLLAPSIBLE ELEMENT
  ///////////////////////////////////
  const toggleHeader = $("#toggle-header");
  if (toggleHeader?.length) {
    toggleHeader.on("click", function () {
      $(this).find("#toggle-icon").toggleClass("rotate-180");
      $("#collapsible-content").toggleClass("max-h-0 max-h-full");
    });
  }

  ///////////////////////////////////
  // PLAY VIDEO
  ///////////////////////////////////
  var videoContainer = $(".video-container");
  if (videoContainer?.length) {
    videoContainer.on("click", "button.play-video", function () {
      var button = $(this);
      var container = button.closest(".video-container");
      var thumbnail = container.find("img");
      var videoDiv = container.find(".video-outer");
      var video = videoDiv.find("video");
      var gradient = container.find(".gradient");

      if (video?.length) {
        video = video[0];

        thumbnail.fadeOut();
        gradient.addClass("closed");
        button.fadeOut();

        video.play();
        videoDiv.fadeIn();
      }
    });
  }

  ///////////////////////////////////
  // ANIMATIONS
  ///////////////////////////////////
  new WOW().init();

  ///////////////////////////////////
  // SLIDERS
  ///////////////////////////////////

  $(".hero-carousel").owlCarousel({
    items: 1,
    loop: true,
    dots: false,
    nav: false,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    onInitialized: updateHeroPagination,
    onChanged: updateHeroPagination,
  });

  function updateHeroPagination(event) {
    var carousel = event.relatedTarget;
    var total = carousel.items().length;
    var current = carousel.relative(carousel.current()) + 1;

    // Atualiza o contador
    $(".hero-carousel-counter").text(
      current.toString().padStart(2, "0") +
        " / " +
        total.toString().padStart(2, "0")
    );

    // Atualiza os dots customizados
    var $dots = $(".hero-carousel-dots");
    $dots.empty();
    for (let i = 1; i <= total; i++) {
      $dots.append(
        `<button class="hero-dot w-4 h-4 rounded-full mr-2 ${
          i === current ? "bg-green-04" : "bg-grey-02/60"
        }"></button>`
      );
    }

    // Clique nos dots
    $(".hero-dot").on("click", function () {
      var index = $(this).index();
      $(".hero-carousel").trigger("to.owl.carousel", [index, 300]);
    });
  }

  $("#carousel-experiences").owlCarousel({
    items: 2, // Número de slides visíveis em telas maiores
    margin: 36,
    dots: true,
    loop: true,
    responsive: {
      0: {
        items: 1,
      },
      1024: {
        items: 2,
      },
    },
  });

  // Seleciona o carrossel pela classe que definimos no HTML
  var $productCarousel = $(".product-carousel");

  if ($productCarousel.length) {
    // Inicializa o Owl Carousel com as opções desejadas
    $productCarousel.owlCarousel({
      loop: false, // 'false' para não voltar ao início depois do último item
      margin: 24, // Espaço em pixels entre os cards de produto
      nav: false, // Desativa as setas de navegação padrão do Owl Carousel
      dots: false, // Desativa os pontos de paginação padrão
      responsive: {
        // 0px e para cima
        0: {
          items: 1, // 1 item em ecrãs de telemóvel
          margin: 16,
        },
        // 768px (tablets) e para cima
        768: {
          items: 2, // 2 itens em ecrãs de tablet
        },
        // 1280px (desktops) e para cima
        1280: {
          items: 3, // 3 itens em ecrãs de desktop, como no seu design
        },
      },
    });

    // Ligar as nossas setas personalizadas à navegação do carrossel
    // Botão "Seguinte"
    $(".carousel-next-btn").on("click", function () {
      $productCarousel.trigger("next.owl.carousel");
    });

    // Botão "Anterior"
    $(".carousel-prev-btn").on("click", function () {
      $productCarousel.trigger("prev.owl.carousel");
    });
  }

  //////////////////////////////////////////////////
  // CARROSSEL VERTICAL PARA O BLOCO 2
  //////////////////////////////////////////////////

  var $block2Carousel = $(".block-2-carousel");
  var $block2DotsContainer = $(".block-2-carousel-dots");

  if ($block2Carousel.length) {
    // Inicializa o carrossel
    $block2Carousel.owlCarousel({
      mouseDrag: false,
      touchDrag: false,
      pullDrag: false,
      items: 1,
      loop: true,
      nav: false,
      dots: false, // Desativamos os dots padrão do Owl
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      animateOut: "animate__slideOutUp",
      animateIn: "animate__slideInUp",
      onInitialized: updateBlock2Dots, // Chama a função para criar os dots
      onChanged: updateBlock2Dots, // Chama a função para atualizar os dots
    });

    // Função que cria/atualiza os dots personalizados
    function updateBlock2Dots(event) {
      var carousel = event.relatedTarget;
      var total = carousel.items().length;
      var current = carousel.relative(carousel.current());

      $block2DotsContainer.empty(); // Limpa os dots antigos

      // Cria um novo dot para cada item
      for (let i = 0; i < total; i++) {
        var dotClass = i === current ? "bg-green-04" : "bg-white/40";
        $block2DotsContainer.append(
          `<button class="block-2-dot w-2 h-2 rounded-full transition-colors ${dotClass}"></button>`
        );
      }
    }

    // ALTERAÇÃO AQUI: O evento de clique é adicionado apenas UMA VEZ
    // ao contentor dos dots, usando "event delegation".
    $block2DotsContainer.on("click", ".block-2-dot", function () {
      var index = $(this).index(); // Pega o índice do dot clicado
      $block2Carousel.trigger("to.owl.carousel", [index, 300]);
    });
  }

  //////////////////////////////////////////////////
  // CARROSSEL PARA A SECÇÃO 'AREAS'
  //////////////////////////////////////////////////
  var $areasCarousel = $(".areas-carousel");

  if ($areasCarousel.length) {
    $areasCarousel.owlCarousel({
      loop: false,
      margin: 24,
      nav: false, // Usamos as nossas setas personalizadas
      dots: true, // Ativamos os pontos
      dotsContainer: ".areas-carousel-dots",
      responsive: {
        0: {
          items: 1, // 1 card em telemóveis
        },
        768: {
          items: 2, // 2 cards em tablets
        },
        1280: {
          items: 3, // 3 cards em desktops
        },
      },
    });

    // Ligar as setas personalizadas à navegação do carrossel
    $(".areas-carousel-next-btn").on("click", function () {
      $areasCarousel.trigger("next.owl.carousel");
    });
    $(".areas-carousel-prev-btn").on("click", function () {
      $areasCarousel.trigger("prev.owl.carousel");
    });

    // Adiciona classes personalizadas aos pontos de navegação
    $areasCarousel
      .on("initialized.owl.carousel changed.owl.carousel", function (event) {
        $(".areas-carousel-dots .owl-dot").each(function () {
          $(this).addClass(
            "w-2.5 h-2.5 rounded-full bg-grey-01 transition-colors"
          );
        });
        $(".areas-carousel-dots .owl-dot.active").addClass("!bg-green-04");
      })
      .trigger("initialized.owl.carousel");
  }

  //////////////////////////////////////////////////
  // CARROSSEL PARA A GALERIA DO ARTIGO
  //////////////////////////////////////////////////
  var $galleryCarousel = $("#carousel-detail-storys");

  if ($galleryCarousel.length) {
    // Inicializa o Owl Carousel
    $galleryCarousel.owlCarousel({
      items: 1,
      loop: true,
      margin: 24,
      nav: false, // Mantemos as setas padrão desativadas
      dots: false,
      onInitialized: updateGalleryCounter,
      onChanged: updateGalleryCounter,
    });

    // Função para criar e atualizar o contador "1 / X" (sem alterações)
    function updateGalleryCounter(event) {
      var element = event.target;
      var items = event.item.count;
      var item = event.item.index + 1;
      if (item > items) {
        item = item - items;
      }

      var counterContainer = $(element)
        .closest("#article-gallery")
        .find(".slider-counter");
      if (counterContainer.length) {
        counterContainer.html(
          "<span>" + item + "</span> / <span>" + items + "</span>"
        );
      }
    }

    // --- NOVO ---
    // Ligar as novas setas de navegação que criámos no HTML
    $("#article-gallery .gallery-next-btn").on("click", function () {
      $galleryCarousel.trigger("next.owl.carousel");
    });

    $("#article-gallery .gallery-prev-btn").on("click", function () {
      $galleryCarousel.trigger("prev.owl.carousel");
    });
  }

  //////////////////////////////////////////////////
  // CARROSSEL PARA A GALERIA DA PÁGINA DE PRODUTO
  //////////////////////////////////////////////////
  var $productGalleryCarousel = $(".product-gallery-carousel");

  if ($productGalleryCarousel.length) {
    $productGalleryCarousel.owlCarousel({
      items: 1,
      loop: true,
      nav: false,
      dots: true, // Ativa os pontos de navegação
    });
  }
  ///////////////////////////////////
  // MODAL
  ///////////////////////////////////
  $(".modal-toggle").on("click", function () {
    const id = $(this).data("modal");
    const modal = $(".modal#" + id);
    if (modal?.length) {
      if (modal.hasClass("opened")) {
        modal.removeClass("opened");
        $("body").removeClass("overflow-hidden");
      } else {
        modal.addClass("opened");
        $("body").addClass("overflow-hidden");
      }
    }
  });
  $(".modal").on("click", ".btn-close, .overlay", function () {
    $(this).closest(".modal").removeClass("opened");
    $("body").removeClass("overflow-hidden");
  });

  ///////////////////////////////////
  // DROPDOWN
  ///////////////////////////////////
  $(".dropdown").on("click", "> button", function (e) {
    e.stopPropagation();

    var dropdownMenu = $(this).next("div");

    $(".dropdown > div").not(dropdownMenu).removeClass("opened");

    dropdownMenu.toggleClass("opened");
  });

  $(document).on("click", function (e) {
    if (!$(e.target).closest(".dropdown").length) {
      $(".dropdown > div").removeClass("opened");
    }
  });

  var page = 1;
  var category = "*";

  $("#load_more_news").on("click", function () {
    page++; // Incrementa o número da página
    var count = $(this).attr("data-count");

    $.ajax({
      url: ajaxurl, // WordPress gera a URL AJAX automaticamente
      type: "post",
      data: {
        action: "get_news", // Nome da ação AJAX no PHP
        page: page,
        category: category,
      },
      success: function (response) {
        if (response == "No more posts") {
          $("#load_more_news").hide(); // Esconde o botão se não houver mais posts
        } else if ($(response).filter("a").length < parseInt(count)) {
          $("#load_more_news").hide(); // Esconde o botão se houver menos de duas tags <a>
          $("#list_news").append(response); // Adiciona o conteúdo retornado à lista de notícias
        } else {
          $("#list_news").append(response); // Adiciona o conteúdo retornado à lista de notícias
        }
      },
    });
  });

  $("#categories_filter").on("click", "button", function () {
    var filter = $(this).attr("data-filter");
    var count = $("#load_more_news").attr("data-count");
    category = filter;
    page = 1;

    $("#categories_filter").find("button.active").removeClass("active");
    $(this).addClass("active");

    $.ajax({
      url: ajaxurl, // WordPress gera a URL AJAX automaticamente
      type: "post",
      data: {
        action: "get_news",
        category: filter,
        page: page,
      },
      success: function (response) {
        if ($(response).filter("a").length < parseInt(count)) {
          $("#load_more_news").hide();
        } else {
          $("#load_more_news").show();
        }
        $("#list_news").html(response); // Adiciona o conteúdo retornado à lista de notícias
      },
      error: function (error) {
        console.log(error);
      },
    }).done(function () {
      // voltar a esconder
    });
  });

  // ///////////////////////////////////
  // FILTRO DE PRODUTOS
  // ///////////////////////////////////

  $(".filter-btn").on("click", function (e) {
    e.preventDefault();

    var $this = $(this);
    var category = $this.data("filter");
    var $productGrid = $("#product-grid");

    // Atualiza o estado visual dos botões
    $(".filter-btn")
      .removeClass("is-active bg-green-04 text-white")
      .addClass(" text-green-01");
    $this
      .addClass("is-active bg-green-04 text-white")
      .removeClass(" text-green-01");

    $.ajax({
      url: my_ajax_object.ajax_url,
      type: "post",
      data: {
        action: "filter_products",
        category: category,
      },
      beforeSend: function () {
        // Efeito de loading: a grelha fica semi-transparente
        $productGrid.css("opacity", 0.5);
      },
      success: function (response) {
        // Substitui o conteúdo da grelha pela resposta do AJAX
        $productGrid.html(response);
      },
      complete: function () {
        // Remove o efeito de loading
        $productGrid.css("opacity", 1);
      },
    });
  });
  //////////////////////////////////////////////////
  // LÓGICA PARA A BARRA DE BADGES 'STICKY' INTELIGENTE
  //////////////////////////////////////////////////

  const heroSection = document.getElementById("hero-section");
  const badgesBar = document.getElementById("badges-bar");

  // Apenas executa se ambos os elementos existirem na página
  if (heroSection && badgesBar) {
    // Adiciona a classe inicial para que a barra comece fixa
    badgesBar.classList.add("is-fixed");

    const observer = new IntersectionObserver(
      (entries) => {
        const heroEntry = entries[0];

        // Verifica se o fundo da secção do herói está a tocar ou já passou o fundo da janela
        if (heroEntry.boundingClientRect.bottom <= window.innerHeight) {
          // Se sim, 'ancora' a barra ao fim da secção
          badgesBar.classList.remove("is-fixed");
          badgesBar.classList.add("is-docked");
        } else {
          // Senão, mantém/volta a pôr a barra fixa no fundo do ecrã
          badgesBar.classList.remove("is-docked");
          badgesBar.classList.add("is-fixed");
        }
      },
      {
        // Este threshold significa que a função é chamada sempre que a visibilidade da secção muda.
        threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1],
      }
    );

    // Diz ao observador para começar a vigiar a secção do herói
    observer.observe(heroSection);
  }
});
