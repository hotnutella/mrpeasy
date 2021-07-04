function countup (username) {
    const newCount = parseInt(document.querySelector('#counter').innerHTML) + 1;
    document.querySelector('#counter').innerHTML = newCount;

    $.post("action/countup.action.php", {
        username: username,
        counter: newCount
    },
    (data) => {
        console.log(data);
    });
}