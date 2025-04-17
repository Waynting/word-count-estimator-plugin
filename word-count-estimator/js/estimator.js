document.addEventListener("DOMContentLoaded", function () {
  const article = document.querySelector(".entry-content");
  const authorElement = document.querySelector(".posted-on");  // 假設發布時間的類別是 .author


  const text = article.innerText || article.textContent;
  const words = text.trim().split(/\s+/).length;
  const readingSpeed = 60;
  const time = Math.ceil(words / readingSpeed);

  // 創建顯示的內容
  const output = document.createElement("div");
  output.className = "wce-output";
  output.innerHTML = `<strong>字數：</strong>${words} 字｜<strong>預估閱讀時間：</strong>${time} 分鐘`;

  authorElement.appendChild(output);  // 把它加入到發布時間的下方
});
