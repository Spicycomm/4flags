       $(function() {
			$(".main-slider").slick({
				dots: true,
				autoplay: true,
				infinite: true,
				arrows: false
			});

			$(".slide-details-course-large").slick({
				dots: false
			});

			$(".slide-details-course-small").slick({
  				slidesToShow: 3,
  				slidesToScroll: 1,
  				arrows: true
			});
			
			
			var showPage = document.querySelectorAll(".show-page"),
				$toggle = document.querySelector(".toggle"),
				closeSection = document.querySelectorAll(".close-section"),
				$menu = document.querySelector(".site-nav"),
				header = document.querySelector(".site-header"),
				$body = document.body,
				$listEvents = document.querySelector(".list-articles"),
 				$viewMore = document.querySelector(".view-more-articles");


      // Menu Mobile

			$toggle.addEventListener("click", function() {
				$menu.classList.toggle("menu-mobile");
				this.classList.toggle("toggle-close");
			});

			function activityUrl() {
				var ids = ["#acontece-na-4flags", "#dicas"];

				
				ids.forEach(function(_id) {
					if($body.scrollTop > document.querySelector(_id).offsetTop && $body.scrollTop <= (document.querySelector(_id).offsetTop + document.querySelector(_id).clientHeight)) {
						pushHistory(_id);
					}
				});

				
			}

			window.document.addEventListener("scroll", function() {
    			  if($body.scrollTop > header.clientHeight) {
          				header.style.position = "fixed";
    				} else {
         				header.style.position = "static";
    				}
				 });

			window.document.addEventListener("scroll", activityUrl);
			

			function getHashs() {
				var _hashs = ["#sobre", "#metodologia", "#missao", "#visao", "#valores", "#cursos", "#garantia", 
							  "#curso-de-ingles", "#curso-de-espanhol", "#curso-de-frances", "#curso-de-portugues"];
				return _hashs;
			}
			
			function hashCourses(el) {
				var _hashs = ["curso-de-ingles", "curso-de-espanhol", "curso-de-frances", "curso-de-portugues"];

				return _hashs.indexOf(el);
			}
			
			function closingPages() {
				var _hashs = getHashs();
				for(var i = 0; i < _hashs.length; i++) {
					document.querySelector(_hashs[i]).style.display = "none";
				}
			};

			showPage.forEach(function(show) {
				show.addEventListener("click", function(evt) {
					evt.preventDefault();
					closingPages();
					
					if(document.querySelector(".full-background") != null) {
						removeBackground(document.querySelector(".full-background"));
					}

					document.querySelector(this.dataset.target).style.display= "block";
					document.querySelector(this.dataset.target).style.top = header.clientHeight;
					pushHistory(this.dataset.target);
					toTop();
					createBackground($body.offsetHeight, header.clientHeight, this.dataset.target);
				});
			});
		

		// Fechar o modal
			closeSection.forEach(function(close) {
				close.addEventListener("click", function(evt) {
					evt.preventDefault();

					if(hashCourses(this.parentElement.parentElement.id) > -1) {
						var page = document.querySelector("#cursos");
						page.style.display = "block";
						page.style.top = header.clientHeight;
						createBackground($body.offsetHeight, header.clientHeight, "#"+ page.id);
					 }

					 this.parentElement
						.parentElement
						.style
						.display = "none";

					removeHistory();
					removeBackground(document.querySelector(".full-background"));
					
				})
			});
 
			

			function pushHistory(url) {
				var removeHash = url.replace("#", ""); 
				return window.history.pushState(null, null, "/" + removeHash);
			}
             
             function removeHistory() {
             	return window.history.pushState(null, null, "/");
             }

             function toTop() {
             	return document.body.scrollTop = "0";
             }
			

             $(".page-scroll a").click(function(evt) {
				evt.preventDefault();
				if(document.querySelector(".full-background")){
					closingPages();
					removeBackground(document.querySelector(".full-background"));
				}
				
				var id = $(this).attr("href");
				var targetOffset = $(id).offset().top;
				
				
				$("html, body").animate({
					scrollTop: targetOffset
				}, 500);
			});  

 	function createBackground(heightBody, heightHeader, hash) {
 		var div = document.createElement("div");
 		var _height = heightBody - heightHeader;

 		div.classList.add("full-background");
 		div.classList.add("_close-section");
 		div.setAttribute("data-hash", hash);
 		div.style.top = heightHeader; 
 		div.style.height = _height;

 		return document.body.appendChild(div);
 	};

 	function removeBackground(_background) {
 		return _background.remove();
 	};

 	
 	$body.addEventListener("click", function(evt) {
 		evt.stopPropagation();
 		if(evt.target.classList.contains("full-background")) {
 			var __hash = document.querySelector(".full-background").dataset.hash.replace("#", ""); 

 			
 			if(hashCourses(__hash) > -1) {
				var page = document.querySelector("#cursos");
				page.style.display = "block";
				page.style.top = header.clientHeight;
				createBackground($body.offsetHeight, header.clientHeight, "#"+ page.id);
			}

 			document.querySelector(evt.target.dataset.hash).style.display = "none";
 			removeBackground(evt.target);
 			removeHistory();
 			
 		}
 		
 	});


 	document.addEventListener("click", function(evt) {
 		document.querySelector("#curso-de-frances").style.display = "none";
 		removeBackground(document.querySelector(".full-background"));
 	});

 	
 	// Ver mais

 		$viewMore.addEventListener("click", function(evt) {
 			evt.preventDefault();
 			if($listEvents.classList.contains("show-more-articles")) {
 				$listEvents.classList.remove("show-more-articles");
 				this.innerText = "Ver Menos";
 			} else {
 				$listEvents.classList.add("show-more-articles");
 				this.innerText = "Ver Mais";
 			}
 		});


 		function urlPathName() {
 			var url = window.location.pathname || "";
 			var ids = ["/acontece-na-4flags", "/dicas"];

 			if(url == "/" || url == "/4flags/") {
 				return;
 			} 

 			else if(ids.indexOf(url) > -1) {
 				url = url.replace("/", "#");
 				document.body.scrollTop = document.querySelector(url).offsetTop - 100;
 			} else {
 				url = url.replace("/", "#");
 				document.querySelector(url).style.display= "block";
				document.querySelector(url).style.top = header.clientHeight;
				toTop();
				createBackground($body.offsetHeight, header.clientHeight, url);
 			}
 		};

 		urlPathName();

});

