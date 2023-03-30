/**
 * Кнопка обратного звонка 3/3
*/

function iw_stat(type)
{
	let url = '' + type,
		img = document.createElement('img');
	img.setAttribute('src',url);
	img.style.display = 'none';
	document.body.appendChild(img);
	let delete_timer = setTimeout(() => {
		img.remove();
	},1000);
}

// функция определения мобильного устройства
// https://blog.foolsoft.ru/javascript-opredelenie-mobilnogo-ustrojstva-ili-funkciya-ismobile/
// https://myrusakov.ru/js-detect-mobile-device.html
window.isMobileOrTablet = function() {
	let check = false;
	(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substring(0,5)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
}

const iw_html = '<div class="icons-widget-wrap is-closed wrap-bt">\
		<a href="#" class="widget-icon-item widget-icon-item-closed" style="opacity: 0;"><i class="fa-solid fa-xmark"></i></a>\
		<a href="' + feedback[2] + '" target="_blank" class="widget-icon-item widget-icon-item-telegram" target="_blank" data-type="telegram"><i class="fa fa-vk" aria-hidden="true"></i></a>\
		<a id="whatsapp-btn" onclick="myWhatsappFunction()" href="' + feedback[1] + '" class="widget-icon-item widget-icon-item-whatsapp" target="_blank" data-type="whatsapp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>\
		<a href="tel:' + feedback[0][1] + '" class="widget-icon-item widget-icon-item-phone is-active" data-type="phone"><i class="fa-solid fa-phone" aria-hidden="true"></i></a>\
                    <div class="waves-block">\
						<div class="waves wave-1"></div>\
						<div class="waves wave-2"></div>\
						<div class="waves wave-3"></div>\
					</div>\
	</div>';

window.is_closed = true;
let current_slide = 4;

//let feedback = document.querySelector('.data-php').getAttribute('data-attr');

//console.log(feedback[0][1])

let style = document.createElement('link');
style.rel = 'stylesheet';
style.type = 'text/css';
style.href = feedback[4];
document.head.append(style);
document.body.insertAdjacentHTML('beforeend',iw_html);

let container = document.querySelector('.icons-widget-wrap'),
	closed =  document.querySelector('.widget-icon-item-closed'),
	icons_data = document.querySelectorAll('.widget-icon-item'),
	site_phone = false,
	site_email = false;

let timer = setInterval(() => {
	if (window.is_closed)
	{
		if (icons_data[current_slide] && icons_data[current_slide].classList.contains("is-active")) icons_data[current_slide].classList.remove('is-active');

		current_slide = current_slide === 1 ? 4 : - 1;

		if (icons_data[current_slide] && icons_data[current_slide].classList.contains("is-active")) icons_data[current_slide].classList.add('is-active');
	}
},3000);

let a_data = document.querySelectorAll('a');

for (let item of a_data)
{
	if (item.getAttribute('href'))
	{
		let href = item.getAttribute('href'),
			href_data = href.split(':');
		if (href_data[0] === 'tel' && !site_phone) site_phone = item;
		if (href_data[0] === 'mailto' && !site_phone) site_email = item;
	}

	if (site_phone && site_email) break;
}

icons_data.forEach(function(item){
	item.addEventListener('click',function(event){
		let type = item.dataset.type;
		if (item.classList.contains('widget-icon-item-closed'))
		{
			event.preventDefault();
			container.classList.add('is-closed');
			window.is_closed = true;
			icons_data.forEach(function(item,index){
				if (window.innerWidth <= 768)
					item.style.bottom = 0;
				else
					item.style.right = 0;
			});
			closed.style.opacity = 0;
			iw_stat('close');
		}
		else if (window.is_closed === true)
		{
			event.preventDefault();
			container.classList.remove('is-closed');
			window.is_closed = false;
			icons_data.forEach(function(item,index){
				if (item.classList.contains('widget-icon-item-closed')) item.style.right = '0px';
				else if (window.innerWidth <= 768) item.style.bottom = (index * (55 + 7)) + 'px';
				else item.style.right = (index * (55 + 7)) + 'px';
			});
			closed.style.opacity = 1;
			iw_stat('open');
		}
		else if (item.getAttribute('href') === '#tel')
		{
			event.preventDefault();
			site_phone.click();
			iw_stat(type);
		}
		else if (item.getAttribute('href') === '#mail')
		{
			event.preventDefault();
			site_email.click();
			iw_stat(type);
		}
		else if (type === 'viber')
		{
			event.preventDefault();
			iw_stat(type);
			let viber_href = item.getAttribute('href'),
			tmpNum = isMobileOrTablet() ? 'add?number=' : 'chat?number=+';
			viber_href = viber_href.replace('[action]', tmpNum);
			window.open(viber_href);
		}
		else
		{
			iw_stat(type);
		}
	});
});