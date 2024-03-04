//Record
function record_display(path) {
    var events = document.querySelectorAll(path).value;
    events.forEach((event_name) => {
        addEventListener("click", () => {
            var curr_timestamp = gen_curr_timestamp();
            record_update(
                JSON.stringify({
                    Author: author,
                    Event: event_name,
                    Curr_timestamp: curr_timestamp,
                })
            );
        });
    });
}

function gen_curr_timestamp() {
    const date = new Date();
    curr_date = date.getDate + "/" + date.getMonth + "/" + date.getFullYear;
    curr_time = date.getSeconds + ":" + date.getMinutes + ":" + date.getHours;
    return curr_date + "  " + curr_time;
}

function record_update(metadata) {
    fetch("/record_Update.php", {
        method: "POST",
        body: metadata,
        headers: { "Content-Type": "application/json" },
    })
        .then((res) => {
            if (!res.ok) {
                throw new Error("Respond Error");
            }
            return res.json();
        })
        .then((data) => {
            console.log(data);
        });
}
