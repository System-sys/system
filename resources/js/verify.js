

///ALERTA
const toast = document.getElementById("invest-toast");
function showToast() {
    toast.classList.remove("hidden");
    setTimeout(() => toast.classList.add("opacity-100"), 50);
    // Se oculta después de 4 segundos
    setTimeout(() => {
        toast.classList.remove("opacity-100");
        setTimeout(() => toast.classList.add("hidden"), 500);
    }, 5000);
}



// Mostrar cada 3 minutos (180000 ms)
setInterval(showToast, 60000);
// Primera muestra de prueba (10 segundos después)
setTimeout(showToast, 10000);

///DISEÑO FOOTER
const coins = [{
    id: "btc-left",
    arrow: "btc-left-arrow",
    value: 45230.12
},
{
    id: "eth-left",
    arrow: "eth-left-arrow",
    value: 3240.80
},
{
    id: "usd-right",
    arrow: "usd-right-arrow",
    value: 1.00
},
{
    id: "sol-right",
    arrow: "sol-right-arrow",
    value: 142.35
},
];

setInterval(() => {
    coins.forEach(c => {
        const delta = (Math.random() - 0.5) * (c.id.includes("usd") ? 0.002 : c.value * 0.0005);
        c.value += delta;
        const el = document.getElementById(c.id);
        const arrow = document.getElementById(c.arrow);
        const up = delta > 0;

        el.textContent = c.value.toFixed(c.id.includes("usd") ? 3 : 2);
        el.className = up ? "text-green-400 transition-colors duration-300" :
            "text-red-400 transition-colors duration-300";
        arrow.textContent = up ? "▲" : "▼";
        arrow.className = up ? "text-green-400 transition-all duration-300" :
            "text-red-400 transition-all duration-300";
    });
}, 1500);



document.querySelectorAll('.typewriter').forEach(el => {
    el.addEventListener('animationend', () => {
        el.classList.add('finished');
    });
});

