function setActiveCategory(category){
	var cat_btn = document.getElementById("category-button");
	var cur_cat = document.getElementById("cur_cat");

	if (category == 1){
		cat_btn.innerHTML="Örhänge";
		cur_cat.value = category;
				
	} else if (category == 2){
		cat_btn.innerHTML="Halsband";
		cur_cat.value = category;

	} else if (category == 3){
		cat_btn.innerHTML="Armband";
		cur_cat.value = category;
	}
}
