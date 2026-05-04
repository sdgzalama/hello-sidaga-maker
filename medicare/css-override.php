<?php
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars ) ) {
	$boldthemes_crush_vars = apply_filters( 'boldthemes_crush_vars', BoldThemesFramework::$crush_vars );
}
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars_def ) ) {
	$boldthemes_crush_vars_def = BoldThemesFramework::$crush_vars_def;
}
if ( isset( $boldthemes_crush_vars['headingFont'] ) ) {
	$headingFont = $boldthemes_crush_vars['headingFont'];
} else {
	$headingFont = "Montserrat,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['headingSuperTitleFont'] ) ) {
	$headingSuperTitleFont = $boldthemes_crush_vars['headingSuperTitleFont'];
} else {
	$headingSuperTitleFont = "?s6t?,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['headingSubTitleFont'] ) ) {
	$headingSubTitleFont = $boldthemes_crush_vars['headingSubTitleFont'];
} else {
	$headingSubTitleFont = "?s6u?,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['menuFont'] ) ) {
	$menuFont = $boldthemes_crush_vars['menuFont'];
} else {
	$menuFont = "Montserrat,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['bodyFont'] ) ) {
	$bodyFont = $boldthemes_crush_vars['bodyFont'];
} else {
	$bodyFont = "Montserrat,Arial,sans-serif";
}
if ( isset( $boldthemes_crush_vars['accentColor'] ) ) {
	$accentColor = $boldthemes_crush_vars['accentColor'];
} else {
	$accentColor = "#0cb8b6";
}
if ( isset( $boldthemes_crush_vars['alterColor'] ) ) {
	$alterColor = $boldthemes_crush_vars['alterColor'];
} else {
	$alterColor = "#f36438";
}
$accentColorHover = CssCrush\fn__l_adjust( $accentColor." -15" );$alterColorHover = CssCrush\fn__l_adjust( $alterColor." -15" );$css_override = sanitize_text_field("a:hover{
    color: {$accentColor};}
select,
input{font-family: {$bodyFont};}
body{font-family: {$bodyFont};}
h1,
h2,
h3,
h4,
h5,
h6{
    font-family: {$headingFont};}
a:hover{color: {$accentColor};}
.btLoader{
    border-right: 2px solid {$accentColor};}
.btBreadCrumbs{
    font-family: {$headingSuperTitleFont};}
.btPageHeadline header .dash .headline:after{
    background: {$accentColor};}
.btAccentColorBackground{background-color: {$accentColor} !important;}
.btAleternateColorBackground{background-color: {$alterColor} !important;}
.topTools .btIconWidgetIcon:hover .btIco .btIcoHolder em,
.btIconWidget .btIconWidgetIcon:hover .btIco .btIcoHolder em{color: {$accentColor} !important;}
.menuPort{font-family: \"{$menuFont}\";}
.menuPort nav ul li a:hover{color: {$accentColor} !important;}
.menuPort nav > ul > li.menu-item-has-children > a:before{
    border-bottom: 6px solid {$accentColor};}
.btMenuHorizontal .menuPort nav > ul > li.current-menu-ancestor > a,
.btMenuHorizontal .menuPort nav > ul > li.current-menu-item > a{box-shadow: 0 -3px 0 0 {$accentColor} inset;}
.btMenuHorizontal .menuPort nav > ul > li > ul li.current-menu-ancestor > a,
.btMenuHorizontal .menuPort nav > ul > li > ul li.current-menu-item > a{color: {$accentColor} !important;}
.btMenuVertical nav li.current-menu-ancestor > a,
.btMenuVertical nav li.current-menu-item > a{color: {$accentColor} !important;}
.subToggler:before{
    color: {$accentColor};}
body.btMenuHorizontal .menuPort ul ul li:first-child > a{border-top: 3px solid {$accentColor};}
body.btMenuHorizontal .menuPort > nav > ul > li.btMenuWideDropdown > ul > li > a,
body.btMenuHorizontal .menuPort > nav > ul > li.btMenuWideDropdown > ul > li:first-child > a{border-top: 3px solid {$accentColor};}
.btVerticalMenuTrigger:hover .btIco:before,
.btVerticalMenuTrigger:hover .btIco:after{border-top-color: {$accentColor};}
.btVerticalMenuTrigger:hover .btIco .btIcoHolder:after{border-top-color: {$accentColor};}
@media (min-width: 1200px){.btMenuVerticalOn .btVerticalMenuTrigger .btIco a:before{color: {$accentColor} !important;}
}.topBar .widget_search button:hover:before,
.topBarInMenu .widget_search button:hover:before{color: {$accentColor};}
.btDarkSkin .topBar .widget_search button:hover:before,
.btDarkSkin .topBarInMenu .widget_search button:hover:before,
.btLightSkin .btDarkSkin .topBar .widget_search button:hover:before,
.btLightSkin .btDarkSkin .topBarInMenu .widget_search button:hover:before{color: {$accentColor};}
.btLightSkin button:hover:before,
.btDarkSkin .btLightSkin button:hover:before{color: {$accentColor};}
.topBarInLogoAreaCell{border: 0 solid {$accentColor};}
.topBarInLogoAreaCell .btSpecialHeaderIcon .btIconWidgetIcon .btIco .btIcoHolder:before,
.topBarInLogoAreaCell .btSpecialHeaderIcon .btIconWidgetIcon .btIco .btIcoHolder:after{color: {$alterColor};}
.topTools.btTopToolsLeft .btIco .btIcoHolder{background-color: {$accentColor};}
.topTools.btTopToolsLeft .btIco .btIcoHolder:hover{background-color: {$alterColor};}
.topTools.btTopToolsLeft .btSpecialHeaderIcon .btIco .btIcoHolder{background-color: {$alterColor};}
.topTools.btTopToolsLeft .btSpecialHeaderIcon .btIco .btIcoHolder:hover{background-color: {$accentColor};}
.infoToggler:before{background-color: {$accentColor};
    border: 1px solid {$accentColor};}
.infoToggler:after{
    color: {$accentColor};
    border: 1px solid {$accentColor};}
.infoToggler.on:after{
    background-color: {$accentColor};}
.infoToggler.on:before{
    color: {$accentColor};}
.btSiteFooter .menu li.btPageTop a:after,
.btSiteFooter .menu li.btPageTop a:before{
    color: {$alterColor};}
.btSiteFooter .menu a:hover{color: {$accentColor};}
.btCustomMenu ul li a:hover{color: {$accentColor};}
.btCustomMenu ul li.btPageTop a:after{
    color: {$alterColor};}
.btInlineFooterMenu.btCustomMenu ul > li > a{
    color: {$accentColor};}
.btFooterWrap.btDarkSkin .btBox h4 .headline a:hover,
.btFooterWrap.btLightSkin .btBox h4 .headline a:hover{color: {$accentColor};}
#boldSiteFooterWidgetsRow .btSpecialHeaderIcon .btIconWidgetIcon .btIco .btIcoHolder:before,
#boldSiteFooterWidgetsRow .btSpecialHeaderIcon .btIconWidgetIcon .btIco .btIcoHolder:after{color: {$alterColor};}
.sticky .headline{color: {$accentColor};}
.headline a{color: {$accentColor};}
.single-portfolio h1,
.single-post h1,
.single-portfolio h2,
.single-post h2{
    color: {$accentColor};}
.portfolioItem dt,
.btPortfolioSingleItemColumns dt{color: {$accentColor};}
.btArticleListItem.btBlogColumnView .btArticleListBodyAuthor a,
.btPostSingleItemColumns .btArticleListBodyAuthor a{color: {$accentColor} !important;}
.commentTxt p.edit-link a:hover,
.commentTxt p.reply a:hover{color: {$accentColor};}
.btBox > h4{
    font-family: \"{$headingSuperTitleFont}\";}
.btBox > h4:after{
    background-color: {$accentColor};}
.btBox ul li a:hover{color: {$accentColor};}
.btBox.widget_calendar table caption{background: {$accentColor};
    font-family: \"{$headingFont}\";}
.btBox.widget_archive ul li a:hover,
.btBox.widget_categories ul li a:hover,
.btCustomMenu ul li a:hover{border-bottom: 1px solid {$accentColor};}
.btDarkSkin .btBox.widget_archive ul li a:hover,
.btLightSkin .btDarkSkin .btBox.widget_archive ul li a:hover,
.btDarkSkin .btBox.widget_categories ul li a:hover,
.btLightSkin .btDarkSkin .btBox.widget_categories ul li a:hover{border-bottom: 1px solid {$accentColor};}
.btBox.widget_rss li a.rsswidget{font-family: \"{$headingFont}\";}
.btBox.widget_rss li cite:before{
    color: {$accentColor};}
.btBox .btSearch button,
.btBox .btSearch input[type=submit],
form.woocommerce-product-search button,
form.woocommerce-product-search input[type=submit]{
    background: {$accentColor};}
.btBox .btSearch button:hover,
form.woocommerce-product-search button:hover{background: {$accentColorHover};}
form.wpcf7-form input[type=\"text\"],
form.wpcf7-form input[type=\"password\"],
form.wpcf7-form input[type=\"email\"],
form.wpcf7-form input[type=\"date\"],
form.wpcf7-form textarea,
form.wpcf7-form .fancy-select .trigger{
    font-family: \"{$bodyFont}\";}
form.wpcf7-form input[type=\"text\"]:focus,
form.wpcf7-form input[type=\"password\"]:focus,
form.wpcf7-form input[type=\"email\"]:focus,
form.wpcf7-form input[type=\"date\"]:focus,
form.wpcf7-form textarea:focus,
form.wpcf7-form .fancy-select .trigger.open{box-shadow: 0 0 0 2px {$accentColor} inset;}
form.wpcf7-form p span.required:after,
form.wpcf7-form p span.bt_bb_required:after{
    color: {$accentColor} !important;}
form.wpcf7-form .wpcf7-submit{
    background-color: {$accentColor};}
form.wpcf7-form .wpcf7-submit:hover{background: {$alterColorHover};}
.fancy-select ul.options > li:hover{color: {$accentColor};}
.btBox .tagcloud a,
.btTags ul a{
    background: {$accentColor};}
.btBox .tagcloud a:hover,
.btTags ul a:hover{background: {$accentColorHover};}
.recentTweets small:before{
    color: {$accentColor};}
.btContentHolder blockquote{
    font-family: \"{$headingSubTitleFont}\";}
.btContentHolder table tr th,
.btContentHolder table thead tr th{background: {$accentColor};}
.post-password-form input[type=\"submit\"]{
    background: {$accentColor};
    font-family: \"{$headingFont}\";}
.btPagination .paging a:hover:after{background: {$accentColor};}
.articleSideGutter a{color: {$accentColor};}
.comment-respond .btnOutline button[type=\"submit\"]{font-family: \"{$headingFont}\";}
a#cancel-comment-reply-link{
    font-family: \"{$bodyFont}\";}
a#cancel-comment-reply-link:hover{color: {$accentColor};}
span.btHighlight{
    background-color: {$accentColor};}
a.btContinueReading{background: {$accentColor};}
a.btContinueReading:hover{background: {$accentColorHover};}
.btArticle .btArticleBody p a,
.btArticle .btArticleBody ul a,
.btArticle .btArticleBody ol a,
.btArticle .btArticleBody table td a,
.btArticle .btArticleBody dl a,
.btArticle .btArticleBody address a,
.btArticle .btArticleBody pre a,
.btArticle .portfolioBody p a,
.btArticle .portfolioBody ul a,
.btArticle .portfolioBody ol a,
.btArticle .portfolioBody table td a,
.btArticle .portfolioBody dl a,
.btArticle .portfolioBody address a,
.btArticle .portfolioBody pre a{color: {$accentColor};}
.btIco .btIcoHolder:before,
.btIco .btIcoHolder:after{color: {$accentColor};}
.btDarkSkin .btTopToolsRight .btIconWidget:hover .btIco .btIcoHolder:before,
.btDarkSkin .btTopToolsRight .btIconWidget:hover .btIco .btIcoHolder:after,
.btLightSkin .btDarkSkin .btTopToolsRight .btIconWidget:hover .btIco .btIcoHolder:before,
.btLightSkin .btDarkSkin .btTopToolsRight .btIconWidget:hover .btIco .btIcoHolder:after{color: {$accentColor};}
.btLightSkin .btTopToolsRight .btIconWidget:hover .btIco .btIcoHolder:before,
.btLightSkin .btTopToolsRight .btIconWidget:hover .btIco .btIcoHolder:after,
.btDarkSkin .btLightSkin .btTopToolsRight .btIconWidget:hover .btIco .btIcoHolder:before,
.btDarkSkin .btLightSkin .btTopToolsRight .btIconWidget:hover .btIco .btIcoHolder:after{color: {$accentColor};}
.btIco.btIcoWhiteType .btIcoHolder em{
    color: {$accentColor};}
.btIco.btIcoFilledType.btIcoAccentColor.btIcoBigSize:hover .btIcoHolder em:before,
.btIco.btIcoOutlineType.btIcoAccentColor.btIcoBigSize .btIcoHolder em:before,
.btIco.btIcoFilledType.btIcoAccentColor.btIcoLargeSize:hover .btIcoHolder em:before,
.btIco.btIcoOutlineType.btIcoAccentColor.btIcoLargeSize .btIcoHolder em:before{box-shadow: 0 0 0 2px {$accentColor} inset;}
.btIco.btIcoFilledType.btIcoAccentColor .btIcoHolder em:before,
.btIco.btIcoOutlineType.btIcoAccentColor:hover .btIcoHolder em:before{box-shadow: 0 0 0 1em {$accentColor} inset;}
.btIco.btIcoFilledType.btIcoAccentColor:hover .btIcoHolder em:before,
.btIco.btIcoOutlineType.btIcoAccentColor .btIcoHolder em:before{box-shadow: 0 0 0 1px {$accentColor} inset;}
.btIco.btIcoFilledType.btIcoAccentColor:hover .btIcoHolder:before,
.btIco.btIcoFilledType.btIcoAccentColor:hover .btIcoHolder:after,
.btIco.btIcoOutlineType.btIcoAccentColor .btIcoHolder:before,
.btIco.btIcoOutlineType.btIcoAccentColor .btIcoHolder:after{color: {$accentColor};}
.btIco.btIcoFilledType.btIcoAlterColor.btIcoBigSize:hover .btIcoHolder em:before,
.btIco.btIcoOutlineType.btIcoAlterColor.btIcoBigSize .btIcoHolder em:before,
.btIco.btIcoFilledType.btIcoAlterColor.btIcoLargeSize:hover .btIcoHolder em:before,
.btIco.btIcoOutlineType.btIcoAlterColor.btIcoLargeSize .btIcoHolder em:before{box-shadow: 0 0 0 2px {$alterColor} inset;}
.btIco.btIcoFilledType.btIcoAlterColor .btIcoHolder em:before,
.btIco.btIcoOutlineType.btIcoAlterColor:hover .btIcoHolder em:before{box-shadow: 0 0 0 1em {$alterColor} inset;}
.btIco.btIcoFilledType.btIcoAlterColor:hover .btIcoHolder em:before,
.btIco.btIcoOutlineType.btIcoAlterColor .btIcoHolder em:before{box-shadow: 0 0 0 1px {$alterColor} inset;}
.btIco.btIcoFilledType.btIcoAlterColor:hover .btIcoHolder:before,
.btIco.btIcoFilledType.btIcoAlterColor:hover .btIcoHolder:after,
.btIco.btIcoOutlineType.btIcoAlterColor .btIcoHolder:before,
.btIco.btIcoOutlineType.btIcoAlterColor .btIcoHolder:after{color: {$alterColor};}
.btLightSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btLightSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:after,
.btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:after,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:after,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:after,
.btDarkSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btDarkSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:after,
.btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:after,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:before,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoAccentColor .btIcoHolder:after,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:after{color: {$accentColor};}
.btLightSkin .btIco.btIcoDefaultType.btIcoAlterColor .btIcoHolder:before,
.btLightSkin .btIco.btIcoDefaultType.btIcoAlterColor .btIcoHolder:after,
.btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:after,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoAlterColor .btIcoHolder:before,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoAlterColor .btIcoHolder:after,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btDarkSkin .btLightSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:after,
.btDarkSkin .btIco.btIcoDefaultType.btIcoAlterColor .btIcoHolder:before,
.btDarkSkin .btIco.btIcoDefaultType.btIcoAlterColor .btIcoHolder:after,
.btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:after,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoAlterColor .btIcoHolder:before,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoAlterColor .btIcoHolder:after,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btLightSkin .btDarkSkin .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:after{color: {$alterColor};}
.btAccentColorBackground .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:before,
.btAccentColorBackground .btIco.btIcoDefaultType.btIcoDefaultColor:hover .btIcoHolder:after{color: {$alterColor} !important;}
.btIcoAccentColor span{color: {$accentColor};}
.btIcoAlterColor span{color: {$alterColor};}
.btIcoDefaultColor:hover span,
.btIcoDefaultColor:hover a.btIcoHolder:after{color: {$accentColor} !important;}
.btCircleIcon.btAccentColorCircle.btFilledCircle,
.btCircleIcon.btAccentColorCircle.btFilledCircle:hover{border-color: {$accentColor};
    background-color: {$accentColor};}
.btCircleIcon.btAccentColorCircle.btHollowCircle,
.btCircleIcon.btAccentColorCircle.btHollowCircle:hover{border-color: {$accentColor};
    color: {$accentColor};}
.btCircleIcon.btAlternateColorCircle.btFilledCircle,
.btCircleIcon.btAlternateColorCircle.btFilledCircle:hover{border-color: {$alterColor};
    background-color: {$alterColor};}
.btCircleIcon.btAlternateColorCircle.btHollowCircle,
.btCircleIcon.btAlternateColorCircle.btHollowCircle:hover{border-color: {$alterColor};
    color: {$alterColor};}
.btnFilledStyle.btnAccentColor,
.btnOutlineStyle.btnAccentColor:hover{background-color: {$accentColor};
    border: 2px solid {$accentColor};}
.btnFilledStyle.btnAlternateColor,
.btnOutlineStyle.btnAlternateColor:hover{background-color: {$alterColor};
    border: 2px solid {$alterColor};}
.btnFilledStyle.btnAccentColor:hover{background-color: {$accentColorHover};
    border: 2px solid {$accentColorHover};}
.btnFilledStyle.btnAlternateColor:hover{background-color: {$alterColorHover};
    border: 2px solid {$alterColorHover};}
.btnOutlineStyle.btnAccentColor{
    border: 2px solid {$accentColor};
    color: {$accentColor};}
.btnOutlineStyle.btnAccentColor span,
.btnOutlineStyle.btnAccentColor span:before,
.btnOutlineStyle.btnAccentColor a,
.btnOutlineStyle.btnAccentColor .btIco a:before,
.btnOutlineStyle.btnAccentColor button{color: {$accentColor} !important;}
.btnOutlineStyle.btnAlternateColor{
    border: 2px solid {$alterColor};
    color: {$alterColor};}
.btnOutlineStyle.btnAlternateColor span,
.btnOutlineStyle.btnAlternateColor span:before,
.btnOutlineStyle.btnAlternateColor a,
.btnOutlineStyle.btnAlternateColor .btIco a:before,
.btnOutlineStyle.btnAlternateColor button{color: {$alterColor} !important;}
.btnBorderlessStyle.btnAccentColor span,
.btnBorderlessStyle.btnNormalColor:hover span,
.btnBorderlessStyle.btnAccentColor span:before,
.btnBorderlessStyle.btnNormalColor:hover span:before,
.btnBorderlessStyle.btnAccentColor a,
.btnBorderlessStyle.btnNormalColor:hover a,
.btnBorderlessStyle.btnAccentColor .btIco a:before,
.btnBorderlessStyle.btnNormalColor:hover .btIco a:before,
.btnBorderlessStyle.btnAccentColor button,
.btnBorderlessStyle.btnNormalColor:hover button{color: {$accentColor};}
.btnBorderlessStyle.btnAlternateColor span,
.btnBorderlessStyle.btnAlternateColor span:before,
.btnBorderlessStyle.btnAlternateColor a,
.btnBorderlessStyle.btnAlternateColor .btIco a:before,
.btnBorderlessStyle.btnAlternateColor button{color: {$alterColor};}
.btCounterHolder{font-family: \"{$headingFont}\";}
.btProgressContent .btProgressAnim{background-color: {$accentColor};}
.btProgressBarLineStyle .btProgressContent .btProgressAnim{
    color: {$accentColor};
    border-bottom: 4px solid {$accentColor};}
.captionTxt:before{color: {$accentColor};}
.btPriceTable .btPriceTableHeader{background: {$accentColor};}
.btLightSkin .btDarkSkin .btPriceTableSticker,
.btDarkSkin .btLightSkin .btDarkSkin .btPriceTableSticker{background: {$alterColor};}
.btDarkSkin .btDarkSkin .btPriceTableSticker,
.btLightSkin .btDarkSkin .btDarkSkin .btPriceTableSticker{
    color: {$accentColor};}
.header .btSuperTitle{font-family: \"{$headingSuperTitleFont}\";}
.header .btSubTitle{font-family: \"{$headingSubTitleFont}\";}
.btLightSkin .btAlternateDash.btDash .dash:after,
.btLightSkin .btAlternateDash.btDash .dash:before,
.btDarkSkin .btLightSkin .btAlternateDash.btDash .dash:after,
.btDarkSkin .btLightSkin .btAlternateDash.btDash .dash:before,
.btDarkSkin .btAlternateDash.btDash .dash:after,
.btDarkSkin .btAlternateDash.btDash .dash:before,
.btLightSkin .btDarkSkin .btAlternateDash.btDash .dash:after,
.btLightSkin .btDarkSkin .btAlternateDash.btDash .dash:before{box-shadow: 0 2px 0 0 {$alterColor} inset;}
.btLightSkin .btAccentDash.btDash .dash:after,
.btLightSkin .btAccentDash.btDash .dash:before,
.btDarkSkin .btLightSkin .btAccentDash.btDash .dash:after,
.btDarkSkin .btLightSkin .btAccentDash.btDash .dash:before,
.btDarkSkin .btAccentDash.btDash .dash:after,
.btDarkSkin .btAccentDash.btDash .dash:before,
.btLightSkin .btDarkSkin .btAccentDash.btDash .dash:after,
.btLightSkin .btDarkSkin .btAccentDash.btDash .dash:before{box-shadow: 0 2px 0 0 {$accentColor} inset;}
.header.small .dash:after,
.header.small .dash:before{box-shadow: 0 1px 0 0 {$accentColor} inset;}
.btGridContent .header .btSuperTitle a:hover{color: {$accentColor};}
.btCatFilter{
    font-family: \"{$menuFont}\";}
.btCatFilter .btCatFilterItem:after{
    background: {$accentColor};}
.btCatFilter .btCatFilterItem:hover{color: {$accentColor};}
.btMediaBox.btQuote,
.btMediaBox.btLink{background-color: {$accentColor};}
h4.nbs.nsPrev a:hover:before,
h4.nbs.nsNext a:hover:after{background-color: {$accentColor};}
.btGhost h4.nbs.nsPrev a:hover:before,
.btGhost h4.nbs.nsNext a:hover:after{background-color: {$accentColor} !important;}
.slided .slick-dots li.slick-active button,
.slided .slick-dots li.slick-active button:hover,
.btDarkSkin .slided .slick-dots li.slick-active button,
.btLightSkin .btDarkSkin .slided .slick-dots li.slick-active button,
.btDarkSkin .slided .slick-dots li.slick-active button:hover,
.btLightSkin .btDarkSkin .slided .slick-dots li.slick-active button:hover{background-color: {$accentColor};}
.btGetInfo{
    background: {$accentColor};}
.btCloseGhost .btIco .btIcoHolder:after{color: {$accentColor};}
.btInfoBarMeta p strong{color: {$accentColor};}
.btLightSkin .tabsHeader li.on span,
.btDarkSkin .btLightSkin .tabsHeader li.on span,
.btLightSkin .tabsHeader li.on a,
.btDarkSkin .btLightSkin .tabsHeader li.on a{box-shadow: 0 -2px 0 0 {$accentColor} inset;}
.btLightSkin .tabsVertical .tabAccordionTitle.on,
.btDarkSkin .btLightSkin .tabsVertical .tabAccordionTitle.on,
.btDarkSkin .tabsVertical .tabAccordionTitle.on,
.btLightSkin .btDarkSkin .tabsVertical .tabAccordionTitle.on{background-color: {$accentColor};
    box-shadow: -52px 0 0 {$accentColorHover} inset;}
.rtl.btLightSkin .tabsVertical .tabAccordionTitle.on,
.rtl.btDarkSkin .btLightSkin .tabsVertical .tabAccordionTitle.on,
.rtl.btDarkSkin .tabsVertical .tabAccordionTitle.on,
.rtl.btLightSkin .btDarkSkin .tabsVertical .tabAccordionTitle.on{box-shadow: 52px 0 0 {$accentColorHover} inset;}
.tabsVertical .tabAccordionTitle:before{color: {$accentColor};}
.tabAccordionTitle.on{background: {$accentColor};}
.btSingleLatestPostFooter a.btArticleComments{border-left: 1px solid {$accentColor};}
.demos span{background-color: {$accentColor};}
.btWorkingHoursInnerLink a{background-color: {$alterColor};}
.btWorkingHoursInnerLink a:hover{
    background-color: {$accentColor};}
.btDarkSkin .btGoogleMapsWrap,
.btLightSkin .btDarkSkin .btGoogleMapsWrap{background-color: {$alterColor};}
span.btInfoPaneToggler{background-color: {$accentColor};}
input[type=\"text\"],
input[type=\"password\"],
input[type=\"email\"],
input[type=\"date\"],
input[type=\"tel\"],
textarea,
.fancy-select .trigger,
.select2-container .select2-choice{font-family: \"{$bodyFont}\";}
input[type=\"text\"]:focus,
input[type=\"password\"]:focus,
input[type=\"email\"]:focus,
input[type=\"tel\"]:focus,
textarea:focus,
.fancy-select .trigger.open,
.select2-container.select2-dropdown-open .select2-choice{box-shadow: 0 0 0 2px {$accentColor} inset;}
.btSpecTypeDropdown .fancy-select .trigger.open{box-shadow: 0 0 0 2px {$accentColor} inset;}
.wCheckBox:before{background-color: {$accentColor};}
.btCustomList li a:before{
    color: {$accentColor};}
.btCustomList li a:hover:before{
    background-color: {$accentColor};}
.btLightSkin .btCustomList li a:hover,
.btDarkSkin .btLightSkin .btCustomList li a:hover,
.btDarkSkin .btCustomList li a:hover,
.btLightSkin .btDarkSkin .btCustomList li a:hover{background-color: {$accentColor};}
.btLightSkin .btCustomList li a:hover:before,
.btDarkSkin .btLightSkin .btCustomList li a:hover:before,
.btDarkSkin .btCustomList li a:hover:before,
.btLightSkin .btDarkSkin .btCustomList li a:hover:before{background-color: {$accentColorHover};}
div.wpcf7-validation-errors{border-color: {$accentColor};
    color: {$accentColor};}
}.ui-datepicker.ui-widget,
.btDatePicker#ui-datepicker-div{font-family: \"{$bodyFont}\";}
.ui-datepicker.ui-widget .ui-datepicker-header{background: {$accentColor};}
.ui-datepicker.ui-widget tbody tr td a.ui-state-default.ui-state-active{box-shadow: 0 0 0 20px {$alterColor} inset;}
.ui-datepicker.ui-widget tbody tr td a.ui-state-default.ui-state-highlight{box-shadow: 0 0 0 20px {$accentColor} inset;}
.ui-datepicker.ui-widget tbody tr td a.ui-state-default.ui-state-hover{box-shadow: 0 0 0 2px {$accentColor} inset;
    color: {$accentColor};}
.slick-dots li.slick-active button,
.slick-dots li.slick-active button:hover{background-color: {$accentColor} !important;}
button.slick-arrow{
    background: {$accentColor};}
button.slick-arrow:hover{background-color: {$accentColor};}
.btLightSkin button.slick-arrow:hover,
.btDarkSkin .btLightSkin button.slick-arrow:hover,
.btDarkSkin button.slick-arrow:hover,
.btLightSkin .btDarkSkin button.slick-arrow:hover{background-color: {$accentColor};}
.bt_bb_arrows_size_large button.slick-arrow:after{
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.bt_bb_arrows_size_large button.slick-arrow:hover:after{box-shadow: 0 0 0 1em {$accentColor} inset;}
.bt_bb_color_scheme_2 .bt_bb_arrows_size_large button.slick-arrow:hover:before,
.bt_bb_color_scheme_5 .bt_bb_arrows_size_large button.slick-arrow:hover:before{color: {$accentColor};}
.wpcf7-form input:not([type='checkbox']):not([type='radio']).wpcf7-submit{
    font-family: \"{$bodyFont}\";
    background: {$accentColor};}
.wpcf7-form input:not([type='checkbox']):not([type='radio']).wpcf7-submit:hover{background: {$accentColorHover} !important;}
.wpcf7-form .btAlterSubmit input:not([type='checkbox']):not([type='radio']).wpcf7-submit{background: {$alterColor};}
.wpcf7-form .btAlterSubmit input:not([type='checkbox']):not([type='radio']).wpcf7-submit:hover{background: {$alterColorHover} !important;}
div.wpcf7 .btSubscribe input[type='submit']{
    background: {$accentColor} !important;}
div.wpcf7 .btFooterSubscribe input[type='submit']{
    background: {$alterColor} !important;}
div.wpcf7 .btFooterSubscribe input[type='submit']:hover{background: {$alterColorHover};}
.bt_bb_progress_bar_advanced > p{
    font-family: \"{$headingFont}\";}
.btLightSkin .bt_bb_features_table table thead tr th,
.btDarkSkin .btLightSkin .bt_bb_features_table table thead tr th{border-bottom-color: {$accentColor};}
.btDarkSkin .bt_bb_features_table table thead tr th,
.btLightSkin .btDarkSkin .bt_bb_features_table table thead tr th{border-bottom-color: {$accentColor};}
.bt_bb_features_table table tbody tr td .bt_bb_features_table_yes:after{
    color: {$accentColor};}
.bt_bb_masonry_image_grid .bt_bb_grid_item .bt_bb_grid_item_inner_image:after{
    color: {$accentColor};}
.bt_bb_post_grid_loader{
    border-right: 2px solid {$accentColor};}
.bt_bb_post_grid_filter{
    font-family: \"{$menuFont}\";}
.bt_bb_post_grid_filter .bt_bb_post_grid_filter_item:after{
    background: {$accentColor};}
.bt_bb_post_grid_filter .bt_bb_post_grid_filter_item:hover{color: {$accentColor};}
.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_category{font-family: \"{$headingSuperTitleFont}\";}
.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title a{color: {$accentColor};}
.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title:before{
    background: {$alterColor};}
.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_meta{
    font-family: \"{$headingSubTitleFont}\";}
.bt_bb_masonry_portfolio_grid .bt_bb_masonry_post_grid_content .bt_bb_grid_item .bt_bb_grid_item_post_content .bt_bb_grid_item_post_share .btIco:hover .btIcoHolder:after{color: {$accentColor};}
.bt_bb_masonry_portfolio_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .bt_bb_grid_item_post_title:before{
    color: {$accentColor};}
.bt_bb_masonry_portfolio_tiles .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_inner_content .bt_bb_grid_item_post_title + .bt_bb_grid_item_post_excerpt:before{
    background: {$alterColor};}
.bt_bb_twitter .bt_bb_twitter_item a{color: {$accentColor};}
.bt_bb_slider .slick-dots li.slick-active button,
.bt_bb_slider .slick-dots li.slick-active button:hover,
.btDarkSkin .bt_bb_slider .slick-dots li.slick-active button,
.btLightSkin .btDarkSkin .bt_bb_slider .slick-dots li.slick-active button,
.btDarkSkin .bt_bb_slider .slick-dots li.slick-active button:hover,
.btLightSkin .btDarkSkin .bt_bb_slider .slick-dots li.slick-active button:hover{background-color: {$accentColor};}
.mfp-gallery button.mfp-close{
    color: {$accentColor};}
.mfp-gallery button.mfp-arrow:hover{background: {$accentColor};}
.btSidebar .btIconWidget .btIconWidgetContent .btIconWidgetTitle{font-family: \"{$headingFont}\";}
.btSidebar .btIconWidget.btSpecialHeaderIcon .btIconWidgetIcon .btIco .btIcoHolder:before,
.btSidebar .btIconWidget.btSpecialHeaderIcon .btIconWidgetIcon .btIco .btIcoHolder:after{color: {$accentColor};}
.bt_bb_before_after_image .bt_bb_before_after_image-horizontal .bt_bb_before_after_image-handle:hover{background: {$accentColor};}
.bt_bb_before_after_image .bt_bb_before_after_image-container.active .bt_bb_before_after_image-handle{background: {$accentColor};}
.bt_bb_before_after_image .bt_bb_before_after_image_block{
    background: {$accentColor};}
.bt_bb_before_after_image .bt_bb_before_after_image_block .bt_bb_before_after_image_headline{font-family: \"{$headingFont}\";}
.bt_bb_before_after_image .bt_bb_before_after_image_block .bt_bb_before_after_image_headline:after{background: {$alterColor};}
.mptt-shortcode-wrapper .mptt-shortcode-table tbody .mptt-event-container{background-color: {$accentColor};}
.mptt-shortcode-wrapper .mptt-shortcode-table tbody .mptt-event-container:hover{background-color: {$alterColor};}
.btNewsletter .btNewsletterColumn input:focus{box-shadow: 0 0 0 3px {$accentColor} !important;}
.btNewsletter .btNewsletterButton input{background: {$alterColor} !important;}
.btNewsletter .btNewsletterButton input:hover{background: {$alterColorHover} !important;
    box-shadow: 0 0 0 3em {$alterColorHover} inset;}
.btAnimNav li.btAnimNavNext:hover,
.btAnimNav li.btAnimNavPrev:hover{color: {$accentColor};}
.headline strong.animate{
    color: {$alterColor};}
.headline b.animate{
    color: {$accentColor};}
p.demo_store{
    background-color: {$accentColor};}
.woocommerce .woocommerce-error,
.woocommerce .woocommerce-info,
.woocommerce .woocommerce-message{
    border-top: 2px solid {$accentColor};}
.woocommerce .woocommerce-info a:not(.button),
.woocommerce .woocommerce-message a:not(.button){color: {$accentColor};}
.woocommerce .woocommerce-message{border-top-color: {$accentColor};}
.woocommerce .woocommerce-message:before{color: {$accentColor};}
.woocommerce .woocommerce-info{border-top-color: {$accentColor};}
.woocommerce .woocommerce-info:before{color: {$accentColor};}
.woocommerce div.product .stock{color: {$accentColor};}
nav.woocommerce-pagination ul li a:focus,
nav.woocommerce-pagination ul li a:hover{background: {$alterColor};}
nav.woocommerce-pagination ul li a.next,
nav.woocommerce-pagination ul li a.prev{background: {$accentColor};}
nav.woocommerce-pagination ul li a.next:hover,
nav.woocommerce-pagination ul li a.prev:hover{
    background: {$alterColor};}
.woocommerce #respond input#submit,
.woocommerce button.button.single_add_to_cart_button,
.woocommerce .button.single_add_to_cart_button,
.woocommerce input.button,
.woocommerce button.button,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce p.buttons a.button,
.woocommerce .woocommerce-message a.button,
button[name=\"calc_shipping\"]{
    color: {$accentColor};
    border: 2px solid {$accentColor};}
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce p.buttons a.button:hover,
.widget_price_filter .price_slider_amount .button:hover{background-color: {$accentColor};}
.woocommerce .woocommerce-message a.button,
.woocommerce a.button.wc-forward,
.woocommerce #review_form .form-submit input[type=\"submit\"]#submit,
.woocommerce .shop_table.cart td.actions input[type=\"submit\"],
.woocommerce .shop_table.cart td.actions button[type=\"submit\"],
.woocommerce .login input[type=\"submit\"],
.woocommerce input.button[name=\"register\"],
.woocommerce input.button[name=\"save_address\"],
.woocommerce p.buttons a.button{background-color: {$accentColor};}
.woocommerce .woocommerce-message a.button:hover,
.woocommerce a.button.wc-forward:hover,
.woocommerce #review_form .form-submit input[type=\"submit\"]#submit:hover,
.woocommerce .shop_table.cart td.actions input[type=\"submit\"]:hover,
.woocommerce .shop_table.cart td.actions button[type=\"submit\"]:hover,
.woocommerce .login input[type=\"submit\"]:hover,
.woocommerce input.button[name=\"register\"]:hover,
.woocommerce input.button[name=\"save_address\"]:hover,
.woocommerce p.buttons a.button:hover,
button[name=\"calc_shipping\"]:hover{background-color: {$accentColorHover};
    border-color: {$accentColorHover};}
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt{background-color: {$accentColor};}
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover{
    color: {$accentColor} !important;}
.woocommerce #respond input#submit.alt.disabled,
.woocommerce #respond input#submit.alt.disabled:hover,
.woocommerce #respond input#submit.alt:disabled,
.woocommerce #respond input#submit.alt:disabled:hover,
.woocommerce #respond input#submit.alt:disabled[disabled],
.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
.woocommerce a.button.alt.disabled,
.woocommerce a.button.alt.disabled:hover,
.woocommerce a.button.alt:disabled,
.woocommerce a.button.alt:disabled:hover,
.woocommerce a.button.alt:disabled[disabled],
.woocommerce a.button.alt:disabled[disabled]:hover,
.woocommerce button.button.alt.disabled,
.woocommerce button.button.alt.disabled:hover,
.woocommerce button.button.alt:disabled,
.woocommerce button.button.alt:disabled:hover,
.woocommerce button.button.alt:disabled[disabled],
.woocommerce button.button.alt:disabled[disabled]:hover,
.woocommerce input.button.alt.disabled,
.woocommerce input.button.alt.disabled:hover,
.woocommerce input.button.alt:disabled,
.woocommerce input.button.alt:disabled:hover,
.woocommerce input.button.alt:disabled[disabled],
.woocommerce input.button.alt:disabled[disabled]:hover{background-color: {$accentColor};}
.woocommerce .star-rating span:before{
    color: {$accentColor};}
.woocommerce p.stars a[class^=\"star-\"].active:after,
.woocommerce p.stars a[class^=\"star-\"]:hover:after{color: {$accentColor};}
.btLightSkin.woocommerce ul.cart_list li .headline a:hover,
.btDarkSkin .btLightSkin.woocommerce ul.cart_list li .headline a:hover,
.btLightSkin.woocommerce ul.product_list_widget li .headline a:hover,
.btDarkSkin .btLightSkin.woocommerce ul.product_list_widget li .headline a:hover,
.btDarkSkin.woocommerce ul.cart_list li .headline a:hover,
.btLightSkin .btDarkSkin.woocommerce ul.cart_list li .headline a:hover,
.btDarkSkin.woocommerce ul.product_list_widget li .headline a:hover,
.btLightSkin .btDarkSkin.woocommerce ul.product_list_widget li .headline a:hover{color: {$accentColor};}
.btFooterWrap.btDarkSkin ul.cart_list li .headline a:hover,
.btFooterWrap.btLightSkin ul.cart_list li .headline a:hover,
.btFooterWrap.btDarkSkin ul.product_list_widget li .headline a:hover,
.btFooterWrap.btLightSkin ul.product_list_widget li .headline a:hover{color: {$accentColor} !important;}
.woocommerce .widget_shopping_cart .total,
.woocommerce.widget_shopping_cart .total{border-top: 2px solid {$accentColor};}
.woocommerce .widget_shopping_cart .cart_list li a.remove:hover,
.woocommerce.widget_shopping_cart .cart_list li a.remove:hover{background-color: {$accentColor};}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{
    background-color: {$accentColor};}
.woocommerce-cart .cart-collaterals .cart_totals .discount td{color: {$accentColor};}
.woocommerce .product_meta .posted_in:before{
    color: {$accentColor};}
.woocommerce .product_meta .posted_in a{color: {$accentColor};}
.woocommerce form.woocommerce-product-search input[type=\"submit\"]{
    background-color: {$accentColor};}
.woocommerce form.woocommerce-product-search .search-field{
    font-family: \"{$bodyFont}\";}
.woocommerce form.woocommerce-product-search .search-field:focus{box-shadow: 0 0 0 2px {$accentColor} inset;}
.woocommerce form.woocommerce-product-search button{
    background: {$accentColor};}
.woocommerce form.woocommerce-product-search button:hover{background: {$accentColorHover};}
td.product-remove a.remove{
    color: {$accentColor};
    border: 1px solid {$accentColor};}
td.product-remove a.remove:hover{background-color: {$accentColor};}
.woocommerce .wc-proceed-to-checkout a.button{
    border: 2px solid {$accentColor};}
.woocommerce p.lost_password:before{
    color: {$accentColor};}
.woocommerce form.login p.lost_password a:hover{color: {$accentColor};}
.woocommerce header.title .edit{
    color: {$accentColor};}
.woocommerce .widget_layered_nav ul li.chosen a:hover:before,
.woocommerce .widget_layered_nav_filters ul li a:hover:before{background-color: {$accentColor};}
a.reset_variations:hover{color: {$accentColor};}
.btLightSkin.woocommerce .product .headline a:hover,
.btDarkSkin .btLightSkin.woocommerce .product .headline a:hover,
.btDarkSkin.woocommerce .product .headline a:hover,
.btLightSkin .btDarkSkin.woocommerce .product .headline a:hover{color: {$accentColor};}
.woocommerce a.button.wc-backward{
    background-color: {$accentColor};}
.woocommerce a.button.wc-backward:hover{background-color: {$accentColorHover};}
.woocommerce-MyAccount-navigation ul{
    font-family: \"{$menuFont}\";}
.woocommerce-MyAccount-navigation ul li a:after{
    background: {$accentColor};}
.woocommerce-MyAccount-navigation ul li a:hover{color: {$accentColor};}
form fieldset legend{
    font-family: \"{$headingFont}\";}
.mainHeader .widget_shopping_cart .btCartWidget:before,
.btMenuVertical .menuPort .widget_shopping_cart .btCartWidget:before{
    border-bottom: 6px solid {$accentColor};}
.mainHeader .widget_shopping_cart .btCartWidgetIcon .bt_bb_icon_holder:before,
.btMenuVertical .menuPort .widget_shopping_cart .btCartWidgetIcon .bt_bb_icon_holder:before{
    color: {$accentColor};}
.mainHeader .widget_shopping_cart .btCartWidgetInnerContent,
.btMenuVertical .menuPort .widget_shopping_cart .btCartWidgetInnerContent{
    border-top: 3px solid {$accentColor};}
.btMenuVertical .menuPort .widget_shopping_cart .btCartWidgetInnerContent .verticalMenuCartToggler:after{
    color: {$accentColor};}
.btQuoteBooking .btContactNext{
    background-color: {$accentColor};
    border: 2px solid {$accentColor};}
.btQuoteBooking .btContactNext:hover,
.btQuoteBooking .btContactNext:active{background-color: {$accentColorHover};
    border: 2px solid {$accentColorHover};}
.btQuoteBooking .btQuoteSwitch:hover{box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btQuoteSwitch.on .btQuoteSwitchInner{
    background: {$accentColor};}
.btQuoteBooking input[type=\"text\"],
.btQuoteBooking input[type=\"email\"],
.btQuoteBooking input[type=\"password\"],
.btQuoteBooking textarea,
.btQuoteBooking .fancy-select .trigger,
.btQuoteBooking .dd.ddcommon .ddTitleText{
    font-family: \"{$bodyFont}\";}
.btQuoteBooking input[type=\"text\"]:focus,
.btQuoteBooking input[type=\"email\"]:focus,
.btQuoteBooking input[type=\"password\"]:focus,
.btQuoteBooking textarea:focus,
.btQuoteBooking .fancy-select .trigger.open,
.btQuoteBooking .dd.ddcommon.borderRadiusTp .ddTitleText{box-shadow: 0 0 0 2px {$accentColor} inset;}
.btQuoteBooking .btQuoteItem textarea{
    font-family: \"{$bodyFont}\";}
.btQuoteBooking .ui-slider .ui-slider-handle{
    background: {$accentColor};}
.btQuoteBooking .btQuoteBookingForm .btQuoteTotal{
    background: {$accentColor};}
.btQuoteBooking .btQuoteTotalCurrency{
    background: {$accentColorHover};}
.btQuoteBooking .btQuoteTotalCalc{
    background: {$accentColorHover};}
.btQuoteBooking .btContactFieldMandatory:after{
    color: {$accentColor};}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError input,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea{border: 1px solid {$accentColor};
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius .ddTitleText{border: 1px solid {$accentColor};
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadius:hover .ddTitleText{box-shadow: 0 0 0 1px {$accentColor} inset,0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError input:focus,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea:focus{box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText{box-shadow: 0 0 0 1px {$accentColor} inset,5px 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
.btQuoteBooking .btSubmitMessage{color: {$accentColor};}
.btDatePicker .ui-datepicker-header{
    background-color: {$accentColor};}
.btQuoteBooking .btContactSubmit{
    background-color: {$accentColor};
    border: 2px solid {$accentColor};}
.btQuoteBooking .btContactSubmit:hover{background-color: {$accentColorHover};
    border: 2px solid {$accentColorHover};}
.btPayPalButton:hover{box-shadow: 0 0 0 {$accentColor} inset,0 1px 5px rgba(0,0,0,.2);}
@media (max-width: 992px){.header.small .dash:after,
.header.small .dash:before{box-shadow: 0 1px 0 0 {$accentColor} inset;}
}@media (max-width: 767px){.btArticleListItem .btArticleFooter .btShareArticle:before{
    background-color: {$accentColor};}
}.wp-block-button__link:hover{color: {$accentColor} !important;}
", array() );