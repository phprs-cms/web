// phprs.eu – přepínač režimu, nabídka na telefonu a hledání v dokumentaci. Bez knihoven.
(function () {
	'use strict';

	var koren = document.documentElement;

	var rezim = document.querySelector('[data-rezim]');
	if (rezim) {
		rezim.addEventListener('click', function () {
			var tmavy = koren.getAttribute('data-theme')
				? koren.getAttribute('data-theme') === 'dark'
				: window.matchMedia('(prefers-color-scheme: dark)').matches;
			var novy = tmavy ? 'light' : 'dark';
			koren.setAttribute('data-theme', novy);
			try { localStorage.setItem('rezim', novy); } catch (e) { /* nevadí */ }
		});
	}

	var menuTl = document.querySelector('[data-menu]');
	var menu = document.getElementById('menu');
	if (menuTl && menu) {
		menuTl.addEventListener('click', function () {
			var otevrene = menu.classList.toggle('je-otevrene');
			menuTl.setAttribute('aria-expanded', otevrene ? 'true' : 'false');
		});
	}

	// na telefonu je seznam kapitol sbalený
	var kapitoly = document.querySelector('.doc-kapitoly');
	if (kapitoly && window.matchMedia('(max-width: 760px)').matches) {
		kapitoly.removeAttribute('open');
	}

	// --- hledání v dokumentaci: index se stáhne až při prvním psaní, hledá se v prohlížeči
	var box = document.querySelector('[data-hledani]');
	if (!box) { return; }
	var pole = box.querySelector('input');
	var vysledky = box.querySelector('.doc-vysledky');
	var index = null;
	var nacita = null;

	function bezDiakritiky(text) {
		return text.normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase();
	}

	function nacti() {
		if (!nacita) {
			nacita = fetch(box.getAttribute('data-hledani'))
				.then(function (r) { return r.json(); })
				.then(function (data) {
					index = data.map(function (z) {
						return { z: z, nadpis: bezDiakritiky(z.s + ' ' + z.n), text: bezDiakritiky(z.t) };
					});
				});
		}
		return nacita;
	}

	function hledej() {
		var slova = bezDiakritiky(pole.value).split(/\s+/).filter(function (s) { return s.length > 1; });
		vysledky.textContent = '';
		if (!slova.length || !index) { vysledky.hidden = true; return; }
		var nalezene = [];
		index.forEach(function (p) {
			var body = 0;
			for (var i = 0; i < slova.length; i++) {
				var vNadpisu = p.nadpis.indexOf(slova[i]) !== -1;
				if (!vNadpisu && p.text.indexOf(slova[i]) === -1) { return; }
				body += vNadpisu ? 5 : 1;
			}
			nalezene.push({ body: body, z: p.z });
		});
		nalezene.sort(function (a, b) { return b.body - a.body; });
		nalezene.slice(0, 8).forEach(function (n) {
			var li = document.createElement('li');
			var a = document.createElement('a');
			a.href = n.z.u;
			a.textContent = n.z.n || n.z.s;
			if (n.z.n) {
				var kde = document.createElement('span');
				kde.textContent = n.z.s;
				a.appendChild(kde);
			}
			li.appendChild(a);
			vysledky.appendChild(li);
		});
		if (!nalezene.length) {
			var nic = document.createElement('li');
			nic.className = 'nic';
			nic.textContent = box.getAttribute('data-nic');
			vysledky.appendChild(nic);
		}
		vysledky.hidden = false;
	}

	pole.addEventListener('input', function () { nacti().then(hledej); });
	pole.addEventListener('focus', function () { nacti(); });
	pole.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') { pole.value = ''; hledej(); }
		if (e.key === 'Enter') {
			var prvni = vysledky.querySelector('a');
			if (prvni) { window.location.href = prvni.href; }
		}
	});
})();
