document.addEventListener("DOMContentLoaded", function () {
  const article = document.querySelector("main");  // 改為選擇 <main> 標籤，確保抓取到文章的全部內容
  const authorElement = document.querySelector(".posted-on");  // 假設發布時間的類別是 .author

  // 遞迴函數，遍歷所有的元素並提取文字
  function getTextFromElement(element) {
    let text = "";
    
    // 遍歷每一個子元素
    element.childNodes.forEach(child => {
      // 如果是文字節點，將文字加入
      if (child.nodeType === Node.TEXT_NODE) {
        text += child.textContent;
      } else if (child.nodeType === Node.ELEMENT_NODE) {
        // 如果是元素節點，遞迴處理
        text += getTextFromElement(child);
      }
    });
    
    return text;
  }

  if (article) {
    // 使用遞迴從整篇文章中提取文字
    const text = getTextFromElement(article);

    // 計算有效的字數
    const words = text.trim().split(/\s+/).length;

    // 設定每分鐘200字的閱讀速度
    const readingSpeed = 200;  // 根據需要可以調整閱讀速度
    const time = Math.ceil(words / readingSpeed);  // 計算預估閱讀時間

    // 創建顯示的內容
    const output = document.createElement("div");
    output.className = "wce-output";
    output.innerHTML = `<strong>字數：</strong>${words} 字｜<strong>預估閱讀時間：</strong>${time} 分鐘`;

    // 把它加入到發布時間的下方
    if (authorElement) {
      authorElement.appendChild(output);
    }
  }
});
