# Word Count Estimator 插件

這個 WordPress 插件自動計算每篇文章的字數與預估閱讀時間，並將結果顯示在文章開頭。它能幫助讀者估算閱讀時間，提高用戶體驗，尤其是當文章較長時。

## 功能

- 自動計算每篇文章的字數。
- 根據預設的閱讀速度（每分鐘200字）預估閱讀時間。
- 顯示預估的閱讀時間與字數於每篇文章的開頭。
- 支援所有單篇文章頁面，並且在頁面載入時動態加載相關 JavaScript 和 CSS。

## 插件安裝

1. 下載 `Word Count Estimator` 插件。
2. 解壓縮並將插件上傳到 `wp-content/plugins` 目錄中。
3. 在 WordPress 管理後台，前往 **插件 > 已安裝插件**，然後啟用 **Word Count Estimator** 插件。

## 插件配置

本插件無需額外配置。安裝並啟用後，它會自動為每篇文章計算字數並顯示預估閱讀時間。

## 插件使用

1. 當你在撰寫文章時，這個插件會自動根據文章的字數計算預估的閱讀時間。
2. 插件會在文章頁面上顯示類似以下內容：
   - **字數**: 1200 字
   - **預估閱讀時間**: 6 分鐘
3. 插件會自動在文章頁面加載時，將這些信息顯示在文章的開頭。

## 開發者說明

### 插件架構

此插件包括以下幾個部分：

- `js/estimator.js`: 用來計算文章的字數和預估閱讀時間的 JavaScript 文件。
- `css/style.css`: 用來樣式化顯示的字數與預估閱讀時間的 CSS 文件。
- `wce_enqueue_scripts()`: 在單篇文章頁面加載時，自動將 JavaScript 和 CSS 載入。

### 主要函式

- **wce_enqueue_scripts**: 這個函式會在每次載入「單篇文章」頁面時，自動將 `estimator.js` 和 `style.css` 文件載入頁面。
  - `wp_enqueue_script` 會載入 JavaScript 文件，並在頁面底部加載。
  - `wp_enqueue_style` 會載入 CSS 文件，並應用於頁面樣式。

```php
function wce_enqueue_scripts() {
    if (is_single()) {
        wp_enqueue_script(
            'wce-estimator',
            plugin_dir_url(__FILE__) . 'js/estimator.js',
            array(), null, true
        );
        wp_enqueue_style(
            'wce-style',
            plugin_dir_url(__FILE__) . 'css/style.css'
        );
    }
}
```

### 插件文件結構
```
/wp-content/plugins/word-count-estimator
    ├── css
    │   └── style.css       # 樣式文件
    ├── js
    │   └── estimator.js    # 計算字數和預估閱讀時間的 JavaScript 文件
    ├── word-count-estimator.php  # 主插件文件
    └── README.md           # 說明文檔
```
---

### 貢獻
歡迎提交 pull requests，貢獻新的功能或修復 bug。請在提交之前先開 issue 討論。

### 注意事項
插件會在單篇文章頁面加載時啟動，因此不會影響其他頁面。
請確保所有需要的 JavaScript 和 CSS 文件已正確加載，這樣才能保證插件的正常運行。

### 版權資訊
這個插件是開源的，使用 GPL2 許可證進行授權。你可以自由使用、修改和分發它。

### 聯絡方式
作者: Wayn Liu
網站: https://waynspace.com/
