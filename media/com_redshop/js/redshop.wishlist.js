!function(t){t(document).ready(function(){t(".redshop-wishlist-button, .redshop-wishlist-link").click(function(e){e.preventDefault();var r=t(this).attr("data-productid"),n=t(this).attr("data-href");if(""!=n&&"undefined"!=typeof n||(n=t(this).attr("href")),""==r||isNaN(r))return!1;n+="&product_id="+r;var i=t("form#addtocart_prd_"+r);if(!i.length)return SqueezeBox.open(n,{handler:"iframe"}),!0;i=t(i[0]);var a=i.children("input#attribute_data"),d=i.children("input#property_data"),u=i.children("input#subproperty_data");return a.length&&(n+="&attribute_id="+encodeURIComponent(t(a[0]).val())),d.length&&(n+="&property_id="+encodeURIComponent(t(d[0]).val())),u.length&&(n+="&subattribute_id="+encodeURIComponent(t(u[0]).val())),SqueezeBox.open(n,{handler:"iframe"}),!0}),t(".redshop-wishlist-form-button, .redshop-wishlist-form-link").click(function(e){e.preventDefault();var r=t(this).attr("data-productid");if(""==r||isNaN(r))return!1;var n=t("form#"+t(this).attr("data-target"));if(!n.length)return!1;var i=t("form#addtocart_prd_"+r);if(!i.length)return n.submit(),!0;i=t(i[0]);var a=i.children("input#attribute_data"),d=i.children("input#property_data"),u=i.children("input#subproperty_data");return a.length&&n.children("input[name='attribute_id']").val(t(a[0]).val()),d.length&&n.children("input[name='property_id']").val(t(d[0]).val()),u.length&&n.children("input[name='subattribute_id']").val(t(u[0]).val()),n.submit(),!0})})}(jQuery);