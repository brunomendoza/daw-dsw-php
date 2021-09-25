(() => {
    const startButtonElem = document.getElementById('start-button')

    startButtonElem.addEventListener(
        'click',
        () => setTimeout(() => location.reload(), 3000)
    )
})()