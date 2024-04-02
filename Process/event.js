
// let stations;
// function generateTable(e, t = null) {
//     const n = document.querySelector("#stationtable tbody"),
//         a = document.querySelector("#pagination"),
//         s = parseInt(document.querySelector("#paginationlist").value),
//         l = t || stations,
//         i = Math.ceil(l.length / s);
//     (n.innerHTML = ""), (a.innerHTML = "");
//     const c = (e - 1) * s,
//         d = Math.min(c + s, l.length);
//     for (let e = c; e < d; e++) {
//         const t = l[e],
//             a = n.insertRow(),
//             s = a.insertCell();
//         (s.textContent = t.name), s.setAttribute("style", "color: rgb(0,0,0);");
//         const i = a.insertCell();
//         (i.textContent = t.code), i.setAttribute("style", "color: rgb(0,0,0);");
//         const c = a.insertCell(),
//             d = document.createElement("a");
//         d.href =
//             "./schedule.html?stationcode=" + t.code + "&stationname=" + t.name;
//         const o = document.createElement("button");
//         (o.textContent = "View Schedule"),
//             o.classList.add("btn", "btn-primary", "btn-sm"),
//             d.appendChild(o),
//             c.appendChild(d),
//             o.addEventListener("click", () => {});
//     }
//     const o = document.createElement("li");
//     o.classList.add("page-item"), 1 === e && o.classList.add("disabled");
//     const r = document.createElement("a");
//     r.classList.add("page-link"),
//         r.setAttribute("aria-label", "Previous"),
//         (r.textContent = "«"),
//         (r.href = "#"),
//         r.addEventListener("click", () => generateTable(e - 1, t)),
//         o.appendChild(r),
//         a.appendChild(o);
//     for (let n = 1; n <= i; n++) {
//         const s = document.createElement("li");
//         s.classList.add("page-item"), n === e && s.classList.add("active");
//         const l = document.createElement("a");
//         l.classList.add("page-link"),
//             (l.textContent = n),
//             (l.href = "#"),
//             l.addEventListener("click", () => generateTable(n, t)),
//             s.appendChild(l),
//             a.appendChild(s);
//     }
//     const m = document.createElement("li");
//     m.classList.add("page-item"), e === i && m.classList.add("disabled");
//     const u = document.createElement("a");
//     u.classList.add("page-link"),
//         u.setAttribute("aria-label", "Next"),
//         (u.textContent = "»"),
//         (u.href = "#"),
//         u.addEventListener("click", () => generateTable(e + 1, t)),
//         m.appendChild(u),
//         a.appendChild(m);
// }
// fetch("./assets/js/stations.json")
//     .then((e) => e.json())
//     .then((e) => {
//         (stations = e), generateTable(1);
//     }),
//     document.querySelector("#searchstation").addEventListener("input", () => {
//         const e = document
//             .querySelector("#searchstation")
//             .value.trim()
//             .toLowerCase();
//         generateTable(
//             1,
//             stations.filter((t) => t.name.toLowerCase().includes(e))
//         );
//     }),
//     document
//         .querySelector("#paginationlist")
//         .addEventListener("change", () => generateTable(1));
