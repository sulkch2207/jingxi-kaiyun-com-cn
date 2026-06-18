<?php

class LinkCard {
    private string $url;
    private string $keyword;
    private string $title;
    private string $description;

    public function __construct(
        string $url,
        string $keyword,
        string $title = '',
        string $description = ''
    ) {
        $this->url = $url;
        $this->keyword = $keyword;
        $this->title = $title ?: $keyword . ' 相关信息';
        $this->description = $description ?: '了解 ' . $keyword . ' 的更多内容';
    }

    public function render(): string {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $escapedKeyword = htmlspecialchars($this->keyword, ENT_QUOTES, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';
        $html .= '<h3 class="link-card-title">' . $escapedTitle . '</h3>';
        $html .= '<p class="link-card-description">' . $escapedDescription . '</p>';
        $html .= '<span class="link-card-keyword">关键词: ' . $escapedKeyword . '</span>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    public function renderWithStyle(): string {
        $style = '<style>
            .link-card {
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                padding: 16px;
                margin: 12px 0;
                background: #ffffff;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                transition: box-shadow 0.3s ease;
            }
            .link-card:hover {
                box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            }
            .link-card a {
                text-decoration: none;
                color: inherit;
                display: block;
            }
            .link-card-title {
                font-size: 18px;
                font-weight: 600;
                color: #333;
                margin: 0 0 8px 0;
            }
            .link-card-description {
                font-size: 14px;
                color: #666;
                margin: 0 0 8px 0;
                line-height: 1.4;
            }
            .link-card-keyword {
                font-size: 12px;
                color: #999;
                display: inline-block;
                padding: 2px 8px;
                background: #f5f5f5;
                border-radius: 4px;
            }
        </style>';

        return $style . $this->render();
    }
}

function renderLinkCard(
    string $url = 'https://jingxi-kaiyun.com.cn',
    string $keyword = '开云',
    string $title = '',
    string $description = ''
): string {
    $card = new LinkCard($url, $keyword, $title, $description);
    return $card->renderWithStyle();
}

// 示例：输出默认卡片
echo renderLinkCard();

// 示例：输出自定义卡片
echo renderLinkCard(
    'https://jingxi-kaiyun.com.cn/example',
    '开云示例',
    '自定义标题',
    '这是自定义描述内容'
);