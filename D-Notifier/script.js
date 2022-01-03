async function getData() {
  const Data = await fetch("https://mrsahil.in/api/", {
    headers: {
      Accept: "application/json"
    }
  });
  const dataObj = await Data.json();
  const content=dataObj.content;
  document.getElementById("link").href=dataObj.image;
  document.getElementById("myImg").src=dataObj.image;
  const display = document.getElementById('notifyElement');
        display.innerHTML = content;
}

getData()