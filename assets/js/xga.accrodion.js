
var xgaAccordion = document.getElementsByClassName('xga-accrodion');
for (var i = 0; i < xgaAccordion.length; i++) {
	var heading = xgaAccordion[i].children[0].children[0];
	heading.onclick = function(ev){
		ev.preventDefault();
		var el = this;
		var content =  this.parentElement.nextElementSibling;
		var contentCLassLissst =  this.parentElement.classList;
		var accParentClass =  this.parentElement.parentElement.getAttribute('class');
		var groupId = document.getElementById(content.getAttribute('data-parent')).getAttribute('id');
		if (content.style.maxHeight && el.classList.contains('open')) {
			//have close accordion
			content.style.maxHeight = null;
			content.classList = 'xga-accordion-body';
		}else{
			//have to open accordion
			var ddd = document.getElementById(groupId)
			var allPrents = ddd.getElementsByClassName(accParentClass);

			// console.log();
            var elclass = el.getAttribute('class');



			for (var i = 0; i < allPrents.length; i++) {
				allPrents[i].children[1].style.maxHeight = null;
				allPrents[i].children[0].children[0].classList.remove('open');
				allPrents[i].children[1].classList.remove('show');
                allPrents[i].children[0].children[0].setAttribute('aria-expanded','false');
			}

            if (  'xga-collapse open' == elclass ) {
                el.setAttribute('aria-expanded','true');

            }
			content.style.maxHeight = content.scrollHeight + 'px';
			content.classList = 'xga-accordion-body show';
		}
		if (el.getAttribute('aria-expanded') == 'true' ) {
			content.style.maxHeight = null;
			content.classList = 'xga-accordion-body';
			el.setAttribute('aria-expanded','false');
			el.classList.remove('open');

		}else{
			this.classList.toggle('open');
			el.setAttribute('aria-expanded','true');
		}
		
	}
}

