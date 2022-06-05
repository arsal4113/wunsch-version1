# Deploy Checklist for Catch
- [ ] Nothing looks broken
 
## Header
- [ ] Click on logo brings you to the homepage.
- [ ] Click on search icon opens the searchbar when not shown and hides the searchbar if shown.
- [ ] Enter "iphone" in searchbar gives search suggestions.
- [ ] Search for "iphone" filter product view with products for "iphone".
- [ ] Click on minicart icon opens empty minicart.
- [ ] Header sticks to top on page scroll.

## Footer
- [ ] "AGB"-Link is working.
- [ ] "Datenschutzerklärung"-Link is working.
- [ ] "Cookies"-Link is working.
- [ ] "Impressum"-Link is working.
- [ ] Footer sticks to bottom on pagescroll.

## Homepage
- [ ] 3 Banners are visible (1 large, 2 small).
- [ ] "Wonach suchst du?" has level 1 categories shown. Check with backend /feeder/feeder-categories
- [ ] "Wonach suchst du?" is a working slider.
- [ ] "Lass dich überraschen!" has items present.
- [ ] "Lass dich überraschen!" is a working slider.
- [ ] "Weitere Produkte" is filed wirth products.
- [ ] "Weitere Produkte" loads more products if you scroll down.
- [ ] Click on a category showing in "Wonach suchst du?" brings you to the coressponding category.

## Category page

### Category slider
- [ ] Level 2 categories are shown for the level 1 category clicked. Check with backend /feeder/feeder-categories
- [ ] Level 2 categorie with level 3 categories shows level 3 categories on click and reloads page to show item for level 2 category.
- [ ] Click on Level 3 category shows products for level 3 categories. Level 2 categories are shown and the parent category of the click level 3 category shows all level 3 categories.
- [ ] Category slider is a working slider.
- [ ] On pagescroll down category slider hides. On page scroll up minified version is shown. On pagescroll to page top full slider is shown.

### Filter
- [ ] Default page ist not filtered. Products are shown for the category between 1 and 20 Euro.
- [ ] Click on show filter icon opens filter.
- [ ] Filter products with a different price range and click on "Checkmark" filters products to only show products within price range.
- [ ] Adding a different filter is reflected by the products shown after clicking "Checkmark" in filter view.
- [ ] The amount of selected filters shown at the filter icon equals the amount of selected filters.

###Products
- [ ] More products are loaded if you scroll down.
- [ ] HeroItems are shown if configured for active category. Check with backend /feeder/feeder-hero-items.
- [ ] Click on product goes to corresponding product view page. 

## Product view

### Product images
- [ ] Click on mini image changes main image.
- [ ] Main image slider is working.
- [ ] Mini image slider is working.

### Product details
- [ ] Product title is shown.
- [ ] Quantity field is present and selectable or shows "Nicht verfügbar".
- [ ] Product price is present.
- [ ] Buy button is present.
- [ ] Product condition, seller, delivery date and return information are present.
- [ ] Click on buy button adds product to cart and redirects to checkout.

### Tabs
- [ ] Tabs are clickable and are changing.
- [ ] Prduct description is fully viewable.
- [ ] Ratings are shown if present else "Noch keine Bewertung verfügbar" is shown
- [ ] Legal infos are present and shown.
- [ ] Return policy and AGB's are formated.
- [ ] Shipping and payment is shown.
- [ ] Excluded countries from shipping are shown.

### Configurable product
- [ ] Configurable drop-down are shown.
- [ ] Color drop-down changes product image.
- [ ] Click on buy button adds product to cart and redirects to checkout.

## Checkout

###Item widget
- [ ] The qty can be changed.
- [ ] The Shipping mehtod can be changed.

### Shipping address widget
- [ ] Shipping address can be entered and saved.
- [ ] On success view changed.
- [ ] On error error is shown. Test with strange telephone number.

### Payment Widget
- [ ] Click on PayPal opens PayPal frame.
- [ ] Authorized PayPal payment enables total widget.

### Totals widget
- [ ] Check of required agreements enables buy botton.
- [ ] Not checked required agreements disable buy button.
