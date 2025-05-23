var loader =
  '<div id="loader"><div class="cssload-container"><div class="cssload-speeding-wheel"></div></div></div>';
var productsContainer;
var addBtn;
var minusBtn;
var value;
//var addToCartBtn;
var counter = 1;
var apiUrl = "index.php?route=product/all/index";
var apiRelatedProductsUrl = "index.php?route=product/related/index&product_id=";
var relatedProductsContainer;
let relatedProductsData = [];
let currentRelatedIndex = 0;
var products = []; // Массив для хранения всех товаров
var categoriesMenu;
var categoriesMenuIcon;
var categoriesMenuClose;
var paramsMenu;
var paramsMenuClose;
var paramsMenuIcon;
var productsPerPage = 16;
var allProducts = [];
var currentPage = 1;
var selectedCategories = [];
var selectedSort = "default"; // Default sorting parameter
var productsPromoContainer;
var limit = 4;
var currentSlide = 0;
var displayedProducts = []; // Массив для хранения товаров, которые отображаются на странице
var currentPromoSlide = 0;
var promoProducts = []; // Массив для хранения всех товаров
var displayedPromoProducts = []; // Массив для хранения товаров, которые отображаются на странице
var apiPromoUrl = "index.php?route=product/all/index";
var searchInput;
var liveSearchContainer;
var liveSearchList;
var resultText;
var menuIcon;
var modalMenu;
var closeMenu;
var cartIconBtn;
var modalCart;
var closeCart;
var togglePageImg;
var searchInputContainer;
var searchIcon; // Предполагается, что у иконки поиска есть id="search-icon"
var closeSearch;
var cartList;
var togglePageBtn;
var firstPage;
var secondPage;
var paginationContainer;
let loadedProducts = 0;
let firstRender = true;
// var parametersMenu;
// var parametersMenuIcon;
// var parametersMenuClose;

function getURLVar(key) {
  var value = [];

  var query = String(document.location).split("?");

  if (query[1]) {
    var part = query[1].split("&");

    for (i = 0; i < part.length; i++) {
      var data = part[i].split("=");

      if (data[0] && data[1]) {
        value[data[0]] = data[1];
      }
    }

    if (value[key]) {
      return value[key];
    } else {
      return "";
    }
  }
}

$(document).ready(function () {
  // Highlight any found errors
  $(".text-danger").each(function () {
    var element = $(this).parent().parent();

    if (element.hasClass("form-group")) {
      element.addClass("has-error");
    }
  });

  // Currency
  $("#form-currency .currency-select").on("click", function (e) {
    e.preventDefault();

    $("#form-currency input[name='code']").val($(this).attr("name"));

    $("#form-currency").submit();
  });

  // Language
  $("#form-language .language-select").on("click", function (e) {
    e.preventDefault();

    $("#form-language input[name='code']").val($(this).attr("name"));

    $("#form-language").submit();
  });

  /* Search */
  $("#search input[name='search']")
    .parent()
    .find("button")
    .on("click", function () {
      var url = $("base").attr("href") + "index.php?route=product/search";

      var value = $("header #search input[name='search']").val();

      if (value) {
        url += "&search=" + encodeURIComponent(value);
      }

      location = url;
    });

  $("#search input[name='search']").on("keydown", function (e) {
    if (e.keyCode == 13) {
      $("header #search input[name='search']")
        .parent()
        .find("button")
        .trigger("click");
    }
  });

  // Menu
  $("#menu .dropdown-menu").each(function () {
    var menu = $("#menu").offset();
    var dropdown = $(this).parent().offset();

    var i =
      dropdown.left +
      $(this).outerWidth() -
      (menu.left + $("#menu").outerWidth());

    if (i > 0) {
      $(this).css("margin-left", "-" + (i + 10) + "px");
    }
  });

  // Product List
  // $('#list-view').click(function() {
  // 	$('#content .product-grid > .clearfix').remove();

  // 	$('#content .row > .product-grid').attr('class', 'product-layout product-list col-xs-12');
  // 	$('#grid-view').removeClass('active');
  // 	$('#list-view').addClass('active');

  // 	localStorage.setItem('display', 'list');
  // });

  // // Product Grid
  // $('#grid-view').click(function() {
  // 	// What a shame bootstrap does not take into account dynamically loaded columns
  // 	var cols = $('#column-right, #column-left').length;

  // 	if (cols == 2) {
  // 		$('#content .product-list').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
  // 	} else if (cols == 1) {
  // 		$('#content .product-list').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12');
  // 	} else {
  // 		$('#content .product-list').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');
  // 	}

  // 	$('#list-view').removeClass('active');
  // 	$('#grid-view').addClass('active');

  // 	localStorage.setItem('display', 'grid');
  // });

  if (localStorage.getItem("display") == "list") {
    $("#list-view").trigger("click");
    $("#list-view").addClass("active");
  } else {
    $("#grid-view").trigger("click");
    $("#grid-view").addClass("active");
  }

  // Checkout
  $(document).on(
    "keydown",
    "#collapse-checkout-option input[name='email'], #collapse-checkout-option input[name='password']",
    function (e) {
      if (e.keyCode == 13) {
        $("#collapse-checkout-option #button-login").trigger("click");
      }
    }
  );

  // tooltips on hover
  $("[data-toggle='tooltip']").tooltip({ container: "body" });

  // Makes tooltips work on ajax generated content
  $(document).ajaxStop(function () {
    $("[data-toggle='tooltip']").tooltip({ container: "body" });
  });
}); // ready

var cart = {
  //'add': function(product_id, q = 1, o = []) {
  add: function (data) {
    $("body").append(loader); //console.log(data);
    $.ajax({
      url: "index.php?route=common/nr_cart/add",
      type: "post",
      dataType: "json",
      data: data,
      // data: {
      // 	product_id: product_id,
      // 	quantity: q,
      // 	option: o
      // },
      success: function (json) {
        $("#loader").remove();
        if (json.error) alert("Błąd: nie określono ważnego parametru!"); //json.error
        if (json.success) {
          minicartRefresh(json.number_products);
          //nrShowMessage(json.success, 1);
        }
      },
      error: function (data) {
        $("#loader").remove();
        console.log(data.responseText);
      },
    });
  },
  update: function (id, q) {
    $("body").append(loader);
    $.ajax({
      url: "index.php?route=common/nr_cart/edit",
      type: "post",
      data: {
        cart_id: id,
        quantity: q,
      },
      success: function (data) {
        $("#loader").remove();
        if (data) minicartRefresh(data);
      },
      error: function (data) {
        $("#loader").remove();
        console.log(data.responseText);
      },
    });
  },
  remove: function (id) {
    $("body").append(loader);
    $.ajax({
      url: "index.php?route=checkout/cart/remove",
      type: "post",
      dataType: "json",
      data: { key: id },
      success: function (json) {
        $("#loader").remove();
        //minicartRefresh(json.number_products);
        // location.reload;
        if (typeof cartUpdate == "function") cartUpdate();
      },
      error: function (data) {
        $("#loader").remove();
        console.log(data.responseText);
      },
    });
  },
};
// Cart add remove functions
// var cart = {
// 	'add': function(product_id, quantity) {
// 		$.ajax({
// 			url: 'index.php?route=common/nr_cart/add',
// 			type: 'post',
// 			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
// 			dataType: 'json',
// 			beforeSend: function() {
// 				$('#cart > button').button('loading');
// 			},
// 			complete: function() {
// 				$('#cart > button').button('reset');
// 			},
// 			success: function(json) {
// 				$('.alert-dismissible, .text-danger').remove();

// 				if (json['redirect']) {
// 					location = json['redirect'];
// 				}

// 				if (json['success']) {
// 					$('#content').parent().before('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

// 					// Need to set timeout otherwise it wont update the total
// 					setTimeout(function () {
// 						$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
// 					}, 100);

// 					$('html, body').animate({ scrollTop: 0 }, 'slow');

// 					$('#cart > ul').load('index.php?route=common/cart/info ul li');
// 				}
// 			},
// 			error: function(xhr, ajaxOptions, thrownError) {
// 				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
// 			}
// 		});
// 	},
// 	'update': function(key, quantity) {
// 		$.ajax({
// 			url: 'index.php?route=checkout/cart/edit',
// 			type: 'post',
// 			data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
// 			dataType: 'json',
// 			beforeSend: function() {
// 				$('#cart > button').button('loading');
// 			},
// 			complete: function() {
// 				$('#cart > button').button('reset');
// 			},
// 			success: function(json) {
// 				// Need to set timeout otherwise it wont update the total
// 				setTimeout(function () {
// 					$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
// 				}, 100);

// 				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
// 					location = 'index.php?route=checkout/cart';
// 				} else {
// 					$('#cart > ul').load('index.php?route=common/cart/info ul li');
// 				}
// 			},
// 			error: function(xhr, ajaxOptions, thrownError) {
// 				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
// 			}
// 		});
// 	},
// 	'remove': function(key) {
// 		$.ajax({
// 			url: 'index.php?route=checkout/cart/remove',
// 			type: 'post',
// 			data: 'key=' + key,
// 			dataType: 'json',
// 			beforeSend: function() {
// 				$('#cart > button').button('loading');
// 			},
// 			complete: function() {
// 				$('#cart > button').button('reset');
// 			},
// 			success: function(json) {
// 				// Need to set timeout otherwise it wont update the total
// 				setTimeout(function () {
// 					$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
// 				}, 100);

// 				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
// 					location = 'index.php?route=checkout/cart';
// 				} else {
// 					$('#cart > ul').load('index.php?route=common/cart/info ul li');
// 				}
// 			},
// 			error: function(xhr, ajaxOptions, thrownError) {
// 				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
// 			}
// 		});
// 	}
// }

var voucher = {
  add: function () {},
  remove: function (key) {
    $.ajax({
      url: "index.php?route=checkout/cart/remove",
      type: "post",
      data: "key=" + key,
      dataType: "json",
      beforeSend: function () {
        $("#cart > button").button("loading");
      },
      complete: function () {
        $("#cart > button").button("reset");
      },
      success: function (json) {
        // Need to set timeout otherwise it wont update the total
        setTimeout(function () {
          $("#cart > button").html(
            '<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' +
              json["total"] +
              "</span>"
          );
        }, 100);

        if (
          getURLVar("route") == "checkout/cart" ||
          getURLVar("route") == "checkout/checkout"
        ) {
          location = "index.php?route=checkout/cart";
        } else {
          $("#cart > ul").load("index.php?route=common/cart/info ul li");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(
          thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
        );
      },
    });
  },
};

var wishlist = {
  add: function (product_id) {
    $.ajax({
      url: "index.php?route=account/wishlist/add",
      type: "post",
      data: "product_id=" + product_id,
      dataType: "json",
      success: function (json) {
        $(".alert-dismissible").remove();

        if (json["redirect"]) {
          location = json["redirect"];
        }

        if (json["success"]) {
          $("#content")
            .parent()
            .before(
              '<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' +
                json["success"] +
                ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
            );
        }

        $("#wishlist-total span").html(json["total"]);
        $("#wishlist-total").attr("title", json["total"]);

        $("html, body").animate({ scrollTop: 0 }, "slow");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(
          thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
        );
      },
    });
  },
  remove: function () {},
};

var compare = {
  add: function (product_id) {
    $.ajax({
      url: "index.php?route=product/compare/add",
      type: "post",
      data: "product_id=" + product_id,
      dataType: "json",
      success: function (json) {
        $(".alert-dismissible").remove();

        if (json["success"]) {
          $("#content")
            .parent()
            .before(
              '<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' +
                json["success"] +
                ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
            );

          $("#compare-total").html(json["total"]);

          $("html, body").animate({ scrollTop: 0 }, "slow");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(
          thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
        );
      },
    });
  },
  remove: function () {},
};

/* Agree to Terms */
$(document).delegate(".agree", "click", function (e) {
  e.preventDefault();

  $("#modal-agree").remove();

  var element = this;

  $.ajax({
    url: $(element).attr("href"),
    type: "get",
    dataType: "html",
    success: function (data) {
      html = '<div id="modal-agree" class="modal">';
      html += '  <div class="modal-dialog">';
      html += '    <div class="modal-content">';
      html += '      <div class="modal-header">';
      html +=
        '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
      html += '        <h4 class="modal-title">' + $(element).text() + "</h4>";
      html += "      </div>";
      html += '      <div class="modal-body">' + data + "</div>";
      html += "    </div>";
      html += "  </div>";
      html += "</div>";

      $("body").append(html);

      $("#modal-agree").modal("show");
    },
  });
});

// Autocomplete */
(function ($) {
  $.fn.autocomplete = function (option) {
    return this.each(function () {
      this.timer = null;
      this.items = new Array();

      $.extend(this, option);

      $(this).attr("autocomplete", "off");

      // Focus
      $(this).on("focus", function () {
        this.request();
      });

      // Blur
      $(this).on("blur", function () {
        setTimeout(
          function (object) {
            object.hide();
          },
          200,
          this
        );
      });

      // Keydown
      $(this).on("keydown", function (event) {
        switch (event.keyCode) {
          case 27: // escape
            this.hide();
            break;
          default:
            this.request();
            break;
        }
      });

      // Click
      this.click = function (event) {
        event.preventDefault();

        value = $(event.target).parent().attr("data-value");

        if (value && this.items[value]) {
          this.select(this.items[value]);
        }
      };

      // Show
      this.show = function () {
        var pos = $(this).position();

        $(this)
          .siblings("ul.dropdown-menu")
          .css({
            top: pos.top + $(this).outerHeight(),
            left: pos.left,
          });

        $(this).siblings("ul.dropdown-menu").show();
      };

      // Hide
      this.hide = function () {
        $(this).siblings("ul.dropdown-menu").hide();
      };

      // Request
      this.request = function () {
        clearTimeout(this.timer);

        this.timer = setTimeout(
          function (object) {
            object.source($(object).val(), $.proxy(object.response, object));
          },
          200,
          this
        );
      };

      // Response
      this.response = function (json) {
        html = "";

        if (json.length) {
          for (i = 0; i < json.length; i++) {
            this.items[json[i]["value"]] = json[i];
          }

          for (i = 0; i < json.length; i++) {
            if (!json[i]["category"]) {
              html +=
                '<li data-value="' +
                json[i]["value"] +
                '"><a href="#">' +
                json[i]["label"] +
                "</a></li>";
            }
          }

          // Get all the ones with a categories
          var category = new Array();

          for (i = 0; i < json.length; i++) {
            if (json[i]["category"]) {
              if (!category[json[i]["category"]]) {
                category[json[i]["category"]] = new Array();
                category[json[i]["category"]]["name"] = json[i]["category"];
                category[json[i]["category"]]["item"] = new Array();
              }

              category[json[i]["category"]]["item"].push(json[i]);
            }
          }

          for (i in category) {
            html +=
              '<li class="dropdown-header">' + category[i]["name"] + "</li>";

            for (j = 0; j < category[i]["item"].length; j++) {
              html +=
                '<li data-value="' +
                category[i]["item"][j]["value"] +
                '"><a href="#">&nbsp;&nbsp;&nbsp;' +
                category[i]["item"][j]["label"] +
                "</a></li>";
            }
          }
        }

        if (html) {
          this.show();
        } else {
          this.hide();
        }

        $(this).siblings("ul.dropdown-menu").html(html);
      };

      $(this).after('<ul class="dropdown-menu"></ul>');
      $(this)
        .siblings("ul.dropdown-menu")
        .delegate("a", "click", $.proxy(this.click, this));
    });
  };
})(window.jQuery);

// Обновление localStorage и отображения счётчика
function updateLocalStorageProductsCount(value) {
  if (!isNaN(value)) {
    sessionStorage.setItem("productsCount", value);
    document.getElementById("cart-count").textContent = value;
  }
}

async function loadRelatedProducts(productId) {
  if (relatedProductsContainer) {
    try {
      const response = await fetch(apiRelatedProductsUrl + productId);
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      const data = await response.json();
      relatedProductsData = data.related_products;
      relatedProductsData = relatedProductsData.map((product) => ({
        ...product,
        image_url: product.thumb || "no_image.png",
      }));
      currentRelatedIndex = 0;
      renderRelatedProduct();
    } catch (error) {
      console.error("Error loading related products:", error);
    }
  }
}

function renderRelatedProduct() {
  relatedProductsContainer.innerHTML = "";
  // Отображаем первые 4 товара (при необходимости можно изменить количество)
  const ui = relatedProductsData.slice(
    currentRelatedIndex,
    currentRelatedIndex + 4
  );
  ui.forEach((product) => {
    relatedProductsContainer.innerHTML += createProductCard(product);
  });
}

// async function loadProducts() {
//     if (productsContainer) {
// 		try {
// 			const response = await fetch(apiUrl);
// 			if (!response.ok) {
// 				throw new Error(`HTTP error! Status: ${response.status}`);
// 			}

// 			const data = await response.json();
// 			products = data.products;
// 			//console.log(products)

// 			const ui = products.slice(0,4)
// 			ui.map((product)=>{
// 				productsContainer.innerHTML+=createProductCard(product)
// 			})

// 		} catch (error) {
// 			console.error('Error loading products:', error);
// 		}
// 	}
// }

// Функция для добавления товара в корзину
// function addToCart() {
//     const productId = addToCartBtn.getAttribute("data-product-id");
//     let currentCount = parseInt(sessionStorage.getItem("productsCount")) || 0;
//     updateLocalStorageProductsCount(currentCount + 1);
//     fetch('index.php?route=checkout/cart/add', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         body: new URLSearchParams({
//             product_id: productId,
//             quantity: counter,
//         }),
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             //console.log(`Product ${productId} with amount ${1} added to cart.`);
//         } else if (data.error) {
//             console.error(data.error);
//             alert(data.error);
//         }
//     })
//     .catch(error => {
//         console.error('Error adding product to cart:', error);
//     });
// }

const addHandler = () => {
  const val = Number(value.innerHTML);
  value.innerHTML = val + 1;
  counter += 1;
};

const minusHandler = () => {
  const val = Number(value.innerHTML);
  if (val > 1) {
    value.innerHTML = val - 1;
    counter -= 1;
  }
};
// Check if the device is mobile
function isMobile() {
  return window.matchMedia("(max-width: 768px)").matches;
}

document.addEventListener("DOMContentLoaded", () => {
  //productsContainer = document.getElementById('products-container');
  productsPromoContainer = document.getElementById("products-container-promo");
  addBtn = document.getElementById("add");
  minusBtn = document.getElementById("minus");
  value = document.getElementById("value");
  //addToCartBtn = document.getElementById("addToCartBtn")
  categoriesMenu = document.getElementById("categories-menu");
  categoriesMenuIcon = document.getElementById("categories-sort");
  categoriesMenuClose = document.getElementById("categories-menu-close");
  paramsMenu = document.getElementById("parameters-menu");
  paramsMenuClose = document.getElementById("parameters-menu-close");
  paramsMenuIcon = document.getElementById("parameters-sort");
  searchInput = document.getElementById("search-input");
  liveSearchContainer = document.getElementById("live-search");
  liveSearchList = liveSearchContainer.querySelector("ul");
  resultText = liveSearchContainer.querySelector(".result-text");
  menuIcon = document.getElementById("menu-icon");
  modalMenu = document.getElementById("modalMenu");
  closeMenu = document.getElementById("closeMenu");
  cartIconBtn = document.getElementById("cart-button");
  modalCart = document.getElementById("modalCart");
  closeCart = document.getElementById("closeCart");
  togglePageImg = document.querySelector("#togglePage img");
  searchInputContainer = document.getElementById("search-input-container");
  searchIcon = document.getElementById("search-icon"); // Предполагается, что у иконки поиска есть id="search-icon"
  closeSearch = document.getElementById("close-search");
  cartList = document.getElementById("cart-list");
  // Switch between pages
  togglePageBtn = document.getElementById("togglePage");
  firstPage = document.getElementById("first-page");
  secondPage = document.getElementById("second-page");
  productsContainer = document.getElementById("products-list");
  relatedProductsContainer = document.getElementById(
    "products-container-related"
  );
  paginationContainer = document.getElementById("pagination");
  // parametersMenu = document.getElementById("parameters-menu");
  // parametersMenuIcon = document.getElementById("parameters-sort");
  // parametersMenuClose = document.getElementById("parameters-menu-close");

  if (cartIconBtn)
    cartIconBtn.addEventListener("click", async () => {
      changeCartVis();
      await fetchCartItems();
    });
  if (closeCart) closeCart.addEventListener("click", changeCartVis);
  // Open and close menu
  if (menuIcon) menuIcon.addEventListener("click", changeVis);
  if (closeMenu) closeMenu.addEventListener("click", changeVis);
  if (togglePageBtn)
    togglePageBtn.addEventListener("click", () => {
      firstPage.classList.toggle("active");
      secondPage.classList.toggle("active");
      // Change button text based on current state
      if (firstPage.classList.contains("active")) {
        togglePageImg.src = "image/catalog/assets/arrow_right.svg"; // Set the arrow to right
      } else {
        togglePageImg.src = "image/catalog/assets/arrow_left.svg"; // Set the arrow to left
      }
    });

  if (addBtn) addBtn.addEventListener("click", addHandler);
  if (minusBtn) minusBtn.addEventListener("click", minusHandler);
  //if (addToCartBtn) addToCartBtn.addEventListener("click",addToCart)

  // // Обработчик изменения фильтров категорий
  // document.querySelectorAll('.category-checkbox').forEach(checkbox => {
  // 	checkbox.addEventListener('change', (e) => {
  // 	const categoryValue = e.target.value;
  // 	if (e.target.checked) {
  // 		selectedCategories.push(categoryValue);
  // 	} else {
  // 		selectedCategories = selectedCategories.filter(category => category !== categoryValue);
  // 	}
  // 	renderUI(currentPage);
  // 	});
  // });

  // Обработчик изменения сортировки
  document.querySelectorAll(".parameters-radio").forEach((radio) => {
    radio.addEventListener("change", (e) => {
      selectedSort = e.target.value;
      renderUI(currentPage);
    });
  });

  // Добавляем обработчики для кнопок переключения слайдов
  // if (document.getElementById('prev-button')) document.getElementById('prev-button').addEventListener('click', () => changeSlide(-1));
  // if (document.getElementById('next-button')) document.getElementById('next-button').addEventListener('click', () => changeSlide(+1));
  if (document.getElementById("prev-promo-button"))
    document
      .getElementById("prev-promo-button")
      .addEventListener("click", () => changePromoSlide(-1));
  if (document.getElementById("next-promo-button"))
    document
      .getElementById("next-promo-button")
      .addEventListener("click", () => changePromoSlide(+1));

  searchInput.addEventListener("input", function () {
    const query = searchInput.value.trim();
    if (query.length < 3) {
      liveSearchContainer.style.display = "none";
      return;
    }

    const searchUrl = `index.php?route=extension/module/live_search&filter_name=${encodeURIComponent(
      query
    )}`;

    fetch(searchUrl)
      .then((response) => response.json())
      .then((data) => {
        //console.log(data)
        liveSearchList.innerHTML = "";
        resultText.innerHTML = "";

        if (data.products && data.products.length > 0) {
          data.products.forEach((product) => {
            const listItem = document.createElement("li");
            listItem.innerHTML = `
                            <a href="${product.url}">
                                ${
                                  product.image
                                    ? `<img src="/image/${product.image}" alt="${product.name}" style="filter: none;width: 40px; height: 40px; margin-right: 10px;">`
                                    : ""
                                }
                                ${product.name} - ${product.price}
                            </a>`;
            liveSearchList.appendChild(listItem);
          });
        } else {
          liveSearchList.innerHTML = `<li style="text-align: center;">nic nie znaleziono</li>`;
        }

        liveSearchContainer.style.display = "block";
      })
      .catch((error) => console.error("Ошибка загрузки данных:", error));
  });

  document.addEventListener("click", function (e) {
    if (!liveSearchContainer.contains(e.target) && e.target !== searchInput) {
      liveSearchContainer.style.display = "none";
    }
  });

  // Открытие поиска
  if (searchIcon)
    searchIcon.addEventListener("click", () => {
      searchInputContainer.classList.add("active");
    });

  // Закрытие поиска
  if (closeSearch)
    closeSearch.addEventListener("click", () => {
      searchInputContainer.classList.remove("active");
    });

  if (paramsMenuIcon)
    paramsMenuIcon.addEventListener("click", () =>
      toggleMenuVisibility(paramsMenu)
    );
  if (paramsMenuClose)
    paramsMenuClose.addEventListener("click", () =>
      toggleMenuVisibility(paramsMenu)
    );
  // if (parametersMenuIcon) parametersMenuIcon.addEventListener("click", () => toggleMenuVisibility(parametersMenu));
  // if (parametersMenuClose) parametersMenuClose.addEventListener("click", () => toggleMenuVisibility(parametersMenu));
  if (categoriesMenuIcon)
    categoriesMenuIcon.addEventListener("click", () =>
      toggleMenuVisibility(categoriesMenu)
    );
  if (categoriesMenuClose)
    categoriesMenuClose.addEventListener("click", () =>
      toggleMenuVisibility(categoriesMenu)
    );

  document.querySelectorAll(".parameters-radio").forEach((radio) => {
    radio.addEventListener("change", () => {
      document.getElementById("sortForm").submit();
    });
  });

  if (isMobile()) {
    firstPage.classList.add("active");
    secondPage.classList.remove("active");
  } else {
    firstPage.classList.add("active");
    secondPage.classList.add("active");
  }

  if (isMobile()) {
    // Скрываем кнопку переключения страниц
    togglePageBtn.style.display = "none";

    // Собираем элементы li из обоих блоков меню
    let combinedItems = [];
    const firstPageItems = firstPage.querySelectorAll("ul li");
    const secondPageItems = secondPage.querySelectorAll("ul li");
    firstPageItems.forEach((item) => combinedItems.push(item.outerHTML));
    secondPageItems.forEach((item) => combinedItems.push(item.outerHTML));
    // Создаём контейнер для объединённого меню
    const unifiedMenu = document.createElement("div");
    unifiedMenu.classList.add("unified-menu");
    // Добавляем список
    unifiedMenu.innerHTML = `<ul>${combinedItems.join("")}</ul>`;
    // Находим блок с социальными иконками через getElementById
    const socialsBlock = document.getElementById("socials");
    if (socialsBlock) {
      unifiedMenu.appendChild(socialsBlock.cloneNode(true));
    }
    // Находим блок с контактной информацией (menu-bottom)
    const menuBottomBlock = document.getElementById("menu-bottom");
    if (menuBottomBlock) {
      unifiedMenu.appendChild(menuBottomBlock.cloneNode(true));
    }
    // Вставляем объединённое меню в начало modalMenu
    modalMenu.insertBefore(unifiedMenu, modalMenu.firstChild);

    // Скрываем оригинальные блоки меню
    firstPage.style.display = "none";
    secondPage.style.display = "none";
  }

  // Загружаем продукты при загрузке страницы
  // loadProducts();
  loadPromoProducts();
  // fetchAllProducts();
  fetchCartItems();
  fetchAndRenderProducts();
});

// Инициализация загрузки корзины при загрузке страницы
document.addEventListener("DOMContentLoaded", async () => {
  //console.log("DOM загружен, инициализирую корзину...");
  await fetchCartProducts(); // Обязательно используем await
});

document.addEventListener("DOMContentLoaded", function () {
  const accordionHeaders = document.querySelectorAll(".accordion-header");

  accordionHeaders.forEach((header) => {
    header.addEventListener("click", function () {
      const content = this.nextElementSibling;

      // Переключение видимости
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        // Закрытие других элементов
        document.querySelectorAll(".accordion-content").forEach((c) => {
          c.style.display = "none";
        });
        content.style.display = "block";
      }
    });
  });
});

const toggleMenuVisibility = (menu) => {
  menu.classList.toggle("active");
};

// Получение параметров из URL
function getQueryParams() {
  const params = new URLSearchParams(window.location.search);
  return {
    category: params.get("category") || "", // Получаем категорию
  };
}

// Устанавливаем категорию из URL при загрузке
function updateFiltersFromURL() {
  const { category } = getQueryParams();
  if (category) {
    selectedCategories = [category]; // Фильтруем по категории
    document.querySelectorAll(".category-checkbox").forEach((checkbox) => {
      if (checkbox.value === category) {
        checkbox.checked = true; // Чекбокс становится активным
      }
    });
  }
}

// Загружаем все продукты
async function fetchAllProducts() {
  try {
    const response = await fetch(apiUrl);
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    const data = await response.json();
    allProducts = data.products;
    //console.log(data.products)
    updateFiltersFromURL(); // Фильтруем сразу при загрузке
    renderUI(currentPage);
    renderPagination();
  } catch (error) {
    console.error("Error loading products:", error);
  }
}

// Фильтрация продуктов по выбранным категориям
function filterProductsByCategories(products) {
  if (selectedCategories.length === 0) {
    return products;
  }
  return products.filter((product) => {
    return selectedCategories.some((category) =>
      product.categories.some((productCategory) =>
        productCategory.toLowerCase().includes(category.toLowerCase())
      )
    );
  });
}

function parsePrice(priceString) {
  const regex = /(\d+,\d+)(zł)?/;
  const match = priceString.match(regex);
  if (match) {
    return parseFloat(match[1].replace(",", "."));
  }
  return 0;
}

function sortProducts(products) {
  // Создаем копию массива, чтобы не мутировать оригинал
  const sorted = products.slice();
  switch (selectedSort) {
    case "popularity":
      sorted.sort((a, b) => b.popularity - a.popularity);
      break;
    // Если выбран параметр "rating" или "rating-DESC", сортируем по убыванию рейтинга
    case "rating":
    case "rating-DESC":
      sorted.sort((a, b) => b.rating - a.rating);
      break;
    // Если выбран "rating-ASC" – сортировка по возрастанию рейтинга
    case "rating-ASC":
      sorted.sort((a, b) => a.rating - b.rating);
      break;
    case "newest":
      sorted.sort((a, b) => new Date(b.date_added) - new Date(a.date_added));
      break;
    case "p.price-ASC":
      sorted.sort((a, b) => parsePrice(a.price) - parsePrice(b.price));
      break;
    case "p.price-DESC":
      sorted.sort((a, b) => parsePrice(b.price) - parsePrice(a.price));
      break;
    case "pd.name-ASC":
      sorted.sort((a, b) => a.name.localeCompare(b.name));
      break;
    case "pd.name-DESC":
      sorted.sort((a, b) => b.name.localeCompare(a.name));
      break;
    case "p.model-ASC":
      sorted.sort((a, b) => (a.model || "").localeCompare(b.model || ""));
      break;
    case "p.model-DESC":
      sorted.sort((a, b) => (b.model || "").localeCompare(a.model || ""));
      break;
    default:
      break;
  }
  return sorted;
}

// Отображение пагинации
function renderPagination() {
  if (paginationContainer) {
    paginationContainer.innerHTML =
      "<button class='pagination-btn'>Pokaż więcej</button>";
    document.querySelectorAll(".pagination-btn").forEach((button) => {
      button.addEventListener("click", (e) => {
        currentPage += 1;
        renderUI(currentPage);
        renderPagination();
      });
    });
  }
}
function parsePrice(priceStr) {
  // Удаляем всё, что не цифра или запятая/точка
  const cleaned = priceStr.replace(/[^\d,.-]/g, "").replace(",", ".");
  return parseFloat(cleaned);
}
function createProductCard(product) {
  const imageUrl = `image/${product.image_url}`;
  const defaultImage = "image/no_image.png"; // Путь к дефолтному изображению
  //  console.log(product.rating);

  const oldPrice = parsePrice(product.old_price);
  const currentPrice = parsePrice(product.price);
  return `
		  <div class="product-card">
			  <div class="product-header">
				  <div class="product-image">
					  <a href="${product.href}">
						  <img src="${imageUrl}" alt="${product.name || "Нет фото"}"
							onerror="this.onerror=null; this.src='${defaultImage}';">
					  </a>
				  </div>
			  </div>
  
			  <div class="product-info">
				  <div class="product-rating">
					  ${Array.from({ length: 5 }, (_, i) =>
              i < product.rating ? "<span>★</span>" : "<span>☆</span>"
            ).join("")}
				  </div>

				  <div class="name-price-block">
					  <div class="product-name" title="${product.name}">
					  <a class="product-link" href="${product.href}">
						  ${product.name}
					  </a>
					  </div>
          <div class="product-price-wrapper">
            ${
              oldPrice > currentPrice
                ? `<div class="product-price old-price">${product.old_price}</div>`
                : ""
            }
            <div class="product-price">
              ${product.price}
            </div>
          </div>

			  </div>
  </div>
			  <div class="product-actions">
				  <div>
					  <button class="add-to-cart" onclick="addToCart(${product.product_id})">
						  DO KOSZYKA
						  <img src="image/catalog/assets/add_to_cart_ico.svg" />
					  </button>
				  </div>
			  </div>
		  </div>
	  `;
}

async function addToCart(productId) {
  $("body").append(loader);
  let currentCount = parseInt(sessionStorage.getItem("productsCount")) || 0;
  updateLocalStorageProductsCount(currentCount + 1);
  fetch("index.php?route=checkout/cart/add", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ product_id: productId, quantity: 1 }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        fetchCartItems();
      } else if (data.error) {
        console.error(data.error);
        alert(data.error);
      }
      $("#loader").remove();
    })
    .catch((error) => {
      console.error("Error adding product to cart:", error);
      $("#loader").remove();
    });
}

// Функция для создания карточки товара
function createProductCartCard(product) {
  return `
		<div class="product-cart-card">
		  <div class="product-thumb">
			<img src="${product.thumb}" alt="${product.name}" onerror="this.onerror=null; this.src='image/no_image.png';">
		  </div>
		  <div class="product-details">
			<p class="product-name">${product.name}</p>
			<div class="quantity-control">
			<button onclick="decrease(${product.product_id})" class="quantity-decrease" data-cart-id="${product.cart_id}">-</button>
			<span class="product-quantity">${product.quantity}</span>
			<button onclick="add(${product.product_id})" class="quantity-increase" data-cart-id="${product.cart_id}">+</button>
		  </div>
		  </div>
		  <div class="product-price">
			<p>${product.price}</p>
		  </div>
		  <button onclick="remove(${product.product_id},${product.quantity})" class="remove-product" data-cart-id="${product.cart_id}">×</button>
		</div>
	  `;
}

// Функция для добавления товара (увеличение счётчика)
async function add(productId) {
  let currentCount = parseInt(sessionStorage.getItem("productsCount")) || 0;
  updateLocalStorageProductsCount(currentCount + 1);
  fetch("index.php?route=checkout/cart/add", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ product_id: productId, quantity: 1 }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        fetchCartItems();
      } else if (data.error) {
        console.error(data.error);
        alert(data.error);
      }
    })
    .catch((error) => {
      console.error("Error adding product to cart:", error);
    });
}

// Функция для уменьшения количества товара
async function decrease(productId) {
  let currentCount = parseInt(sessionStorage.getItem("productsCount")) || 0;
  updateLocalStorageProductsCount(currentCount - 1);
  fetch("index.php?route=checkout/cart/add", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ product_id: productId, quantity: -1 }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        fetchCartItems();
      } else if (data.error) {
        console.error(data.error);
        alert(data.error);
      }
    })
    .catch((error) => {
      console.error("Error decreasing product quantity:", error);
    });
}

// Функция для удаления товара (уменьшение счётчика на count)
async function remove(productId, count) {
  let currentCount = parseInt(sessionStorage.getItem("productsCount")) || 0;
  updateLocalStorageProductsCount(currentCount - count);
  fetch("index.php?route=checkout/cart/add", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ product_id: productId, quantity: -count }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        fetchCartItems();
      } else if (data.error) {
        console.error(data.error);
        alert(data.error);
      }
    })
    .catch((error) => {
      console.error("Error removing product from cart:", error);
    });
}

async function loadProducts() {
  if (productsContainer) {
    try {
      const response = await fetch(apiUrl);
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      const data = await response.json();
      products = data.products;

      ui.map((product) => {
        productsContainer.innerHTML += createProductCard(product);
      });
    } catch (error) {
      console.error("Error loading products:", error);
    }
  }
}

async function loadPromoProducts() {
  if (productsPromoContainer) {
    try {
      const response = await fetch(apiPromoUrl);
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      const data = await response.json();
      promoProducts = data.products;

      const ui = promoProducts.slice(0, 4);
      ui.map((product) => {
        productsPromoContainer.innerHTML += createProductCard(product);
      });
    } catch (error) {
      console.error("Error loading products:", error);
    }
  }
}

function changeSlide(dirrection) {
  if (productsContainer) {
    if ((currentSlide == 0) & (dirrection < 1)) {
      return;
    }
    if ((products.length == currentSlide + 4) & (dirrection == 1)) {
      return;
    }

    currentSlide += dirrection;

    displayedProducts = products.slice(currentSlide, currentSlide + 4);
    displayedProducts.map((product) => {
      productsContainer.innerHTML += createProductCard(product);
    });
  }
}

function changePromoSlide(dirrection) {
  if (productsPromoContainer) {
    if ((currentPromoSlide == 0) & (dirrection < 1)) {
      return;
    }
    if ((promoProducts.length == currentPromoSlide + 4) & (dirrection == 1)) {
      return;
    }

    currentPromoSlide += dirrection;

    displayedPromoProducts = promoProducts.slice(
      currentPromoSlide,
      currentPromoSlide + 4
    );
    productsPromoContainer.innerHTML = "";
    displayedPromoProducts.map((product) => {
      productsPromoContainer.innerHTML += createProductCard(product);
    });
  }
}

function updateShopingCartSummary(products) {
  let totalPrice = 0;

  products.forEach((product) => {
    totalPrice += parseFloat(product.total.replace("$", "").replace(",", "."));
  });

  document.getElementById("total").textContent = `${totalPrice.toFixed(2)} zł`;
  updateLocalStorageProductsCount(products.length);
}

// Toggle visibility of cart items
function renderCartItems(products) {
  cartList.innerHTML = "";
  if (products.length === 0) {
    cartList.innerHTML = "<p>Koszyk jest pusty</p>";
    return;
  }

  products.forEach((product) => {
    cartList.innerHTML += createProductCartCard(product);
  });

  attachEventListeners();
}

// Fetch cart items from the server
const fetchCartItems = async () => {
  try {
    const response = await fetch("index.php?route=checkout/cart/getList", {
      method: "GET",
    });

    if (!response.ok) {
      throw new Error(`Ошибка: ${response.status}`);
    }

    const data = await response.json();
    renderCartItems(data.products);
    updateShopingCartSummary(data.products);
  } catch (error) {
    console.error("Błąd podczas zamawiania towarów:", error);
    cartList.innerHTML = "<p>Błąd podczas ładowania koszyka</p>";
  }
};

// Add event listeners for quantity change and item removal
function attachEventListeners() {
  document.querySelectorAll(".quantity-increase").forEach((button) => {
    button.addEventListener("click", (event) => {
      const cartId = event.target.getAttribute("data-cart-id");
      //console.log(`Increase quantity for cart_id: ${cartId}`);
    });
  });

  document.querySelectorAll(".quantity-decrease").forEach((button) => {
    button.addEventListener("click", (event) => {
      const cartId = event.target.getAttribute("data-cart-id");
      //console.log(`Decrease quantity for cart_id: ${cartId}`);
    });
  });

  document.querySelectorAll(".remove-product").forEach((button) => {
    button.addEventListener("click", (event) => {
      const cartId = event.target.getAttribute("data-cart-id");
      //console.log(`Remove product with cart_id: ${cartId}`);
    });
  });
}

// Functions to toggle visibility of modal windows
const changeVis = () => {
  modalMenu.classList.toggle("active");
};

const changeCartVis = () => {
  modalCart.classList.toggle("active");
};

// Функция для обновления итоговой суммы
function updateCartSummary(products) {
  let totalPrice = 0;
  products.forEach((product) => {
    totalPrice += parseFloat(product.total.replace("$", "").replace(",", "."));
  });

  const shippingCost = 19; // Установите фиксированную стоимость доставки
  document.getElementById(
    "total-price"
  ).textContent = `Cena: ${totalPrice.toFixed(2)} zł`;
  document.getElementById(
    "shipping-cost"
  ).textContent = `Koszt przesyłki: ${shippingCost} zł`;
  document.getElementById("grand-total").textContent = `Wszystko: ${(
    totalPrice + shippingCost
  ).toFixed(2)} zł`;
}

// Функция для отображения товаров в корзине
function renderCartProducts(products) {
  const cartList = document.getElementById("checkout-list");
  cartList.innerHTML = ""; // Очищаем текущий список

  if (products.length === 0) {
    cartList.innerHTML = "<p>Koszyk jest pusty</p>";
    return;
  }

  products.forEach((product) => {
    cartList.innerHTML += createProductCartCard(product);
  });

  attachCartEventListeners(); // Добавляем обработчики событий
  updateCartSummary(products); // Обновляем подытог
}

// Функция для загрузки данных корзины
const fetchCartProducts = async () => {
  try {
    //console.log("Запрашиваю товары..."); // Отладка
    const response = await fetch("index.php?route=checkout/cart/getList", {
      method: "GET",
    });

    if (!response.ok) {
      throw new Error(`Ошибка: ${response.status}`);
    }

    const data = await response.json();
    //console.log("Получены данные корзины:", data); // Отладка

    if (data && data.products) {
      renderCartProducts(data.products);
    } else {
      //console.error("Нет товаров в ответе от сервера.");
      document.getElementById("cart-list").innerHTML =
        "<p>Koszyk jest pusty</p>";
    }
  } catch (error) {
    //console.error("Ошибка при запросе товаров:", error);
    document.getElementById("cart-list").innerHTML =
      "<p>Błąd podczas ładowania koszyka</p>";
  }
};

// Функция для привязки событий к элементам корзины
function attachCartEventListeners() {
  document.querySelectorAll(".quantity-increase").forEach((button) => {
    button.addEventListener("click", (event) => {
      const cartId = event.target.getAttribute("data-cart-id");
      //console.log(`Увеличить количество для cart_id: ${cartId}`);
      // Добавьте логику увеличения количества на сервере
    });
  });

  document.querySelectorAll(".quantity-decrease").forEach((button) => {
    button.addEventListener("click", (event) => {
      const cartId = event.target.getAttribute("data-cart-id");
      //console.log(`Уменьшить количество для cart_id: ${cartId}`);
      // Добавьте логику уменьшения количества на сервере
    });
  });

  document.querySelectorAll(".remove-product").forEach((button) => {
    button.addEventListener("click", (event) => {
      const cartId = event.target.getAttribute("data-cart-id");
      //console.log(`Удалить товар с cart_id: ${cartId}`);
      // Добавьте логику удаления товара из корзины на сервере
    });
  });
}

function normalizeCategory(category) {
  return category.toLowerCase().replace(/[-_]/g, " ").trim();
}

// Извлечение категории из URL (например, site/category)
function getCategoryFromUrl() {
  const pathSegments = window.location.pathname.split("/").filter(Boolean);
  return pathSegments[pathSegments.length - 1] || "";
}

async function fetchAndRenderProducts() {
  try {
    const response = await fetch(apiUrl);
    if (!response.ok) {
      throw new Error(`HTTP error: ${response.status}`);
    }
    const data = await response.json();

    // Фильтрация продуктов по категории из URL
    const urlCategory = normalizeCategory(getCategoryFromUrl());
    // console.log("URL категория:", urlCategory);
    if ("sklep" == urlCategory) {
      allProducts = data.products;
    } else {
      allProducts = data.products.filter((product) =>
        product.categories.some((prodCat) =>
          normalizeCategory(prodCat).includes(urlCategory)
        )
      );
      allProducts = sortProducts(allProducts);
    }

    renderUI(currentPage);
    renderPagination();
  } catch (error) {
    //console.error("Ошибка при загрузке продуктов:", error);
    if (productsContainer)
      productsContainer.innerHTML = "<p>Błąd podczas ładowania produktów.</p>";
  }
}

// function renderPagination() {
//   const totalPages = Math.ceil(allProducts.length / productsPerPage);
//   paginationContainer.innerHTML = "";

//   if (totalPages <= 1) return; // Если страниц одна — пагинация не нужна

//   // Кнопка "назад"
//   if (currentPage > 1) {
//     paginationContainer.innerHTML += `<div class="pagination-btn" data-page="${currentPage - 1}">&lt;</div>`;
//   }

//   // Номера страниц
//   for (let i = 1; i <= totalPages; i++) {
//     paginationContainer.innerHTML += `
//       <div class="pagination-btn ${i === currentPage ? "active" : ""}" data-page="${i}">${i}</div>
//     `;
//   }

//   // Кнопка "вперёд"
//   if (currentPage < totalPages) {
//     paginationContainer.innerHTML += `<div class="pagination-btn" data-page="${currentPage + 1}">&gt;</div>`;
//   }

//   // Добавляем обработчики кликов для кнопок пагинации
//   document.querySelectorAll(".pagination-btn").forEach(button => {
//     button.addEventListener("click", (e) => {
//       currentPage = parseInt(e.target.dataset.page, 10);
//       renderUI(currentPage);
//       renderPagination();
//     });
//   });
// }

// document.addEventListener('DOMContentLoaded', () => {
//     const carousel = document.querySelector('.categories-carousel');
//     const content = document.querySelector('#carousel-content');
//     const pagination = document.querySelector('#carousel-pagination');
//     const slides = document.querySelectorAll('.categories-carousel .slide');
//     const slidesToShow = 1.3; // Отображаем 1.5 слайда за раз
//     const slideWidthPercentage = (100 / slidesToShow); // Ширина каждого слайда, если показываем 1.5
//     let currentIndex = 0;

//     // Function to update carousel position and pagination
//     const updateCarousel = () => {
//       content.style.transform = `translateX(-${currentIndex * slideWidthPercentage}%)`;

//       // Remove existing active wrapper div, if any
//       const activeWrapper = pagination.querySelector('.active-wrapper');
//       if (activeWrapper) {
//         activeWrapper.remove();
//       }

//       // Create a new wrapper div for the active button
//       const activeDiv = document.createElement('div');
//       activeDiv.classList.add("pagination-div", 'active');

//       const wrapperDiv = document.createElement('div');
//       wrapperDiv.classList.add('active-wrapper');
//       wrapperDiv.appendChild(activeDiv);

//       // Insert the new active wrapper into the correct place
//       const buttons = pagination.querySelectorAll('div');
//       buttons[currentIndex].parentNode.insertBefore(wrapperDiv, buttons[currentIndex].nextSibling);
//     };

//     // Initialize pagination buttons based on the number of slides
//     const totalPages = Math.ceil(slides.length / slidesToShow);
//     for (let i = 0; i < totalPages; i++) {
//       const button = document.createElement('div');
//       button.classList.add("pagination-div");
//       button.addEventListener('click', () => {
//         currentIndex = i;
//         updateCarousel();
//       });
//       pagination.appendChild(button);
//     }

//     // Set the width of each slide
//     slides.forEach((slide) => {
//       slide.style.width = `${slideWidthPercentage}%`;
//     });

//     // Swipe detection for touch events
//     let startX = 0;
//     let isSwiping = false;

//     // Touch events
//     carousel.addEventListener('touchstart', (e) => {
//       startX = e.touches[0].clientX;
//       isSwiping = true;
//     });

//     carousel.addEventListener('touchmove', (e) => {
//       if (!isSwiping) return;
//       const moveX = e.touches[0].clientX;
//       const diffX = startX - moveX;

//       // Detect swipe left (next slide) or swipe right (previous slide)
//       if (Math.abs(diffX) > 50) {
//         if (diffX > 0 && currentIndex < slides.length - slidesToShow) {
//           currentIndex++;
//         } else if (diffX < 0 && currentIndex > 0) {
//           currentIndex--;
//         }
//         updateCarousel();
//         isSwiping = false;
//       }
//     });

//     carousel.addEventListener('touchend', () => {
//       isSwiping = false;
//     });

//     // Mouse swipe detection
//     let mouseStartX = 0;
//     let isMouseSwiping = false;

//     carousel.addEventListener('mousedown', (e) => {
//       mouseStartX = e.clientX;
//       isMouseSwiping = true;
//       carousel.style.cursor = 'grabbing'; // Change cursor to indicate dragging
//     });

//     carousel.addEventListener('mousemove', (e) => {
//       if (!isMouseSwiping) return;

//       const moveX = e.clientX;
//       const diffX = mouseStartX - moveX;

//       // Detect mouse drag left (next slide) or drag right (previous slide)
//       if (Math.abs(diffX) > 50) {
//         if (diffX > 0 && currentIndex < slides.length - slidesToShow) {
//           currentIndex++;
//         } else if (diffX < 0 && currentIndex > 0) {
//           currentIndex--;
//         }
//         updateCarousel();
//         isMouseSwiping = false;
//       }
//     });

//     carousel.addEventListener('mouseup', () => {
//       isMouseSwiping = false;
//       carousel.style.cursor = 'grab'; // Reset cursor
//     });

//     carousel.addEventListener('mouseleave', () => {
//       isMouseSwiping = false;
//       carousel.style.cursor = 'grab'; // Reset cursor when leaving carousel area
//     });

//     // Initial update
//     updateCarousel();
// });

//   document.addEventListener("DOMContentLoaded", function () {
//     const images = [
//         "image/catalog/assets/mobile_categories_demo.png",
//         "image/catalog/assets/mobile_categories_demo.png",
//         "image/catalog/assets/mobile_categories_demo.png",
//         "image/catalog/assets/mobile_categories_demo.png",
//         "image/catalog/assets/mobile_categories_demo.png",
//         "image/catalog/assets/mobile_categories_demo.png",
//         "image/catalog/assets/mobile_categories_demo.png",
//         "image/catalog/assets/mobile_categories_demo.png",
//     ]; // Замените на реальные пути изображений

//     const slides = document.querySelectorAll(".categories-carousel-mobile p");
//     const imageElement = document.getElementById("categories-carousel-mobile-slide");
//     let currentIndex = 0;

//     function changeSlide() {
//         // Убираем активный класс у всех элементов
//         slides.forEach(slide => {
//             slide.classList.remove("categories-carousel-mobile-active-slide-text");
//             slide.classList.add("categories-carousel-mobile-slide-text");
//         });

//         // Меняем изображение
//         imageElement.src = images[currentIndex];

//         // Добавляем активный класс к текущему слайду
//         slides[currentIndex].classList.remove("categories-carousel-mobile-slide-text");
//         slides[currentIndex].classList.add("categories-carousel-mobile-active-slide-text");

//         // Увеличиваем индекс и зацикливаем
//         currentIndex = (currentIndex + 1) % slides.length;
//     }

//     // Запускаем интервал смены слайдов каждые 3 секунды
//     setInterval(changeSlide, 3000);
// });

document.addEventListener("DOMContentLoaded", () => {
  // Десктопная карусель
  var slides = document.querySelectorAll(".upper-slide");
  var bgImage = document.getElementById("carousel-bg");

  const items = [
    {
      bg: "image/catalog/assets/cherry_bg.jpg",
      img: "image/catalog/assets/cherry.png",
    },
    {
      bg: "image/catalog/assets/honey_bg.jpg",
      img: "image/catalog/assets/honey.png",
    },
    {
      bg: "image/catalog/assets/chocolate_bg.jpg",
      img: "image/catalog/assets/chocolate.png",
    },
    {
      bg: "image/catalog/assets/currant_bg.jpg",
      img: "image/catalog/assets/currant.png",
    },
    {
      bg: "image/catalog/assets/lemon_bg.jpg",
      img: "image/catalog/assets/lemon.png",
    },
  ];

  let currentIndex = 0;

  function updateDesktopCarousel() {
    //console.log(slides);
    if (slides.length > 0) {
      const prevSlide = slides[currentIndex];
      prevSlide.classList.remove("active");

      currentIndex = (currentIndex + 1) % items.length;

      const nextSlide = slides[currentIndex];
      nextSlide.classList.add("active");

      const newBg = items[currentIndex].bg;
      bgImage.classList.remove("active"); // Скрываем старый фон
      setTimeout(() => {
        bgImage.src = newBg;
        bgImage.classList.add("active"); // Плавное появление нового фона
      }, 50);
    }
  }

  setInterval(updateDesktopCarousel, 2500);

  // Мобильная карусель
  var mobileSlide = document.querySelector(".carousel-mobile .slide img");
  var mobileBackground = document.querySelector(".carousel-mobile .top img");

  let mobileIndex = 0;

  function updateMobileCarousel() {
    if (mobileSlide) {
      mobileSlide.classList.remove("active");
      mobileBackground.classList.remove("active");

      // Переходим к следующему индексу
      mobileIndex = (mobileIndex + 1) % items.length;

      const newBg = items[mobileIndex].bg;
      const newSlide = items[mobileIndex].img;

      setTimeout(() => {
        mobileBackground.src = newBg;
        mobileSlide.src = newSlide;

        mobileBackground.classList.add("active");
        mobileSlide.classList.add("active");
      }, 50); // Добавляем задержку перед появлением
    }
  }

  // Устанавливаем начальный слайд для мобильной карусели
  if (mobileBackground) mobileBackground.classList.add("active");
  if (mobileSlide) mobileSlide.classList.add("active");

  // Запускаем цикл обновления мобильной карусели
  setInterval(updateMobileCarousel, 2500);
});

document.addEventListener("DOMContentLoaded", function () {
  const categoryDropdown = document.getElementById("categories-dropdown");
  const sortDropdown = document.getElementById("sort-dropdown");

  if (categoryDropdown) {
    categoryDropdown.addEventListener("change", function () {
      const selectedCategory = this.value;
      if (selectedCategory) {
        window.location.href = selectedCategory;
      }
    });
  }

  if (sortDropdown) {
    sortDropdown.addEventListener("change", function () {
      const selectedSort = this.value;
      const url = new URL(window.location.href);
      url.searchParams.set("sort", selectedSort);
      window.location.href = url.toString();
    });
  }
});
document.addEventListener("DOMContentLoaded", function () {
  const cartIconBtn = document.getElementById("cart-button");

  if (cartIconBtn) {
    const urlParams = new URLSearchParams(window.location.search);
    const route = urlParams.get("route"); // Получаем значение параметра route
    const path = window.location.pathname.toLowerCase(); // Получаем путь

    if ((route && route.includes("checkout")) || path.includes("hurtownia")) {
      cartIconBtn.style.display = "none";
    }
  }
});
document.addEventListener("DOMContentLoaded", () => {
  // Читаем параметр 'sort' из URL и устанавливаем выбранный параметр сортировки
  const urlParams = new URLSearchParams(window.location.search);
  const sortParam = urlParams.get("sort");

  if (sortParam) {
    selectedSort = sortParam;
  }

  // Далее – загрузка и отрисовка товаров с учётом параметра сортировки
  fetchAndRenderProducts();
});

document.addEventListener("DOMContentLoaded", () => {
  const relatedContainer = document.getElementById(
    "products-container-related"
  );
  const productId = relatedContainer.getAttribute("data-product-id");
  loadRelatedProducts(productId);

  document.getElementById("related-prev").addEventListener("click", () => {
    let total = relatedProductsData.length;
    if (currentRelatedIndex - 4 < 0) {
      currentRelatedIndex = total - 4;
    } else {
      currentRelatedIndex -= 4;
    }
    renderRelatedProduct();
  });

  document.getElementById("related-next").addEventListener("click", () => {
    let total = relatedProductsData.length;
    if (currentRelatedIndex + 4 >= total) {
      currentRelatedIndex = 0;
    } else {
      currentRelatedIndex += 4;
    }
    renderRelatedProduct();
  });
});

function renderUI() {
  // Фильтрация товаров по категории из URL
  const urlCategory = normalizeCategory(getCategoryFromUrl());
  let filteredProducts = [];

  if (urlCategory && urlCategory !== "sklep") {
    filteredProducts = allProducts.filter((product) =>
      product.categories.some((cat) => normalizeCategory(cat) === urlCategory)
    );
  } else {
    filteredProducts = allProducts;
  }

  // Сортировка отфильтрованных товаров по выбранному параметру
  filteredProducts = sortProducts(filteredProducts);

  // Пагинация: вычисляем индексы для отображения товаров на текущей странице
  const startIndex = (currentPage - 1) * productsPerPage;
  const endIndex = currentPage * productsPerPage;
  const productsToDisplay = filteredProducts.slice(startIndex, endIndex);

  // Очищаем контейнер и отрисовываем товары для текущей страницы
  if (productsContainer) {
    if (urlCategory && urlCategory !== "sklep") {
      filteredProducts = allProducts.filter((product) =>
        product.categories.some((cat) => normalizeCategory(cat) === urlCategory)
      );
    }
    if (firstRender) {
      productsContainer.innerHTML = "";
      firstRender = false;
    } else {
      productsToDisplay.forEach((product) => {
        productsContainer.innerHTML += createProductCard(product);
      });
    }
  }

  // Обновляем пагинацию:
  // Если endIndex меньше общего числа отфильтрованных товаров,
  // выводим кнопку "Dalej" для перехода на следующую страницу,
  // иначе очищаем контейнер пагинации.
  if (paginationContainer) {
    if (endIndex < filteredProducts.length) {
      paginationContainer.innerHTML = `<button class='pagination-btn' id="next-page-btn">Dalej</button>`;
      document.getElementById("next-page-btn").addEventListener("click", () => {
        currentPage++;
        renderUI();
      });
    } else {
      paginationContainer.remove();
    }
  }
}
