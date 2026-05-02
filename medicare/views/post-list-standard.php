<?php

	$share_html = '<div class="btIconRow">' . ( function_exists( 'boldthemes_get_share_html' ) ? boldthemes_get_share_html( $permalink, 'blog', 'btIcoSmallSize', 'btIcoOutlineType btIcoAccentColor' ) : '' ) . '</div>';

	$supertitle_html = '';
	$subtitle_html = '';
	$dash = '';

	if ( $blog_author || $blog_date || $show_comments_number ) {
		if ( ! $blog_side_info ) {
			
			if ( $blog_date ) {
				$supertitle_html .= '<span class="btArticleDate">' . esc_html( date_i18n( MedicareTheme::$boldthemes_date_format, strtotime( get_the_date( 'Y-m-d' ) ) ) ) . ' </span>'; 
			}
			
			if ( $blog_author ) {
				$supertitle_html .= $author_html;
			}

			$supertitle_html .= $categories_html;

			if ( $show_comments_number ) {
				$supertitle_html .= '<a href="' . esc_url_raw( $permalink ) . '#comments" class="btArticleComments">' . esc_html( $comments_number ) . '</a>';
			}
			
			$dash = $blog_use_dash ? "top" : "";
		} else {
			$supertitle_html .= $categories_html;
			$dash = $blog_use_dash ? "top" : "";
			if ( $show_comments_number ) {
				$supertitle_html .= '<a href="' . esc_url_raw( $permalink ) . '#comments" class="btArticleComments">' . esc_html( $comments_number ) . '</a>';
			}
		}
		
		
	} else {
		
	}

	
	
	echo '<article class="' . esc_attr( implode( ' ', get_post_class( $class_array ) ) ) . '">';
		echo '<div class="port">';
			echo '<div class="boldCell">';
			if($media_html != "") {
				echo '<div class = "boldRow">';
					echo '<div class="rowItem col-sm-12 btTextCenter">' . ( $media_html ) . '</div>';
				echo '</div><!-- /boldRow -->';
			}

			if ( $blog_side_info && ! is_search() ) {
				echo '<div class="articleSideGutter btTextCenter">';
				$avatar_html = get_avatar( get_the_author_meta( 'ID' ), 144 ); 
					
				if ( $avatar_html != '' ) {
					echo '<div class="asgItem avatar"><a href="' . esc_url_raw( $author_url ) . '">' . wp_kses_post( $avatar_html ) . '</a></div>';
				}
				if ( $blog_author ) {
					echo '<div class="asgItem title"><span>' . wp_kses_post( $author_html ) . '</span></div>';
				}
				if ( $blog_date ) {
					echo '<div class="asgItem date"><small><span class="btArticleDate">' . date_i18n( "d", strtotime( get_the_date( 'Y-m-d' ) ) ) . "/". date_i18n( "M", strtotime( get_the_date( 'Y-m-d' ) ) ). "/". date_i18n( "Y", strtotime( get_the_date( 'Y-m-d' ) ) ) . '</span></small></div>';
				}	
				
				echo '</div>';
			}
			
				$extra_class = '';
				if ( $post_format == 'link' && $media_html == '' ) {
					$extra_class = 'linkOrQuote';
				}
				echo '<div class="boldRow btArticleListBody' . esc_attr( $extra_class ) . '">';
					echo '<div class="rowItem col-sm-12">';
						echo '<div class="rowItemContent">';
							echo '<div class="btClear btSeparator bottomSmallSpaced noBorder"><hr></div>';
							echo boldthemes_get_heading_html( $supertitle_html, '<a href="' . esc_url_raw( $permalink ) . '">' . get_the_title() . '</a>', wp_kses_post( $subtitle_html ), 'large', $dash, 'btAlternateDash', '' );
							echo '<div class="btArticleListBodyContent">' . $content_final_html . '</div>';
						echo '</div>' ;
						echo '<div class="btClear btSeparator bottomSmallSpaced border"><hr></div>';
					echo '</div>';
				echo '</div><!-- /boldRow -->';
				
			
				echo '<div class="boldRow btArticleFooter">';
					echo '<div class="rowItem col-sm-6 col-ms-12 btTextLeft btReadArticle"><a class="btContinueReading" href="' . esc_url_raw( $permalink ) . '">' . esc_html__( 'CONTINUE READING', 'medicare' ) . '</a></div>';
					echo '<div class="rowItem col-sm-6 col-ms-12 btTextRight btShareArticle">' . wp_kses_post( $share_html ) . '</div>';
				echo '</div><!-- /boldRow -->';
			echo '</div><!-- boldCell -->';			
		echo '</div><!-- port -->';
	echo '</article><!-- /articles -->';

?>