$(function() {
	//highlight the current nav 
        $("#Homepage a:contains('Home')").parent().addClass('active');
        $("#Quest a:contains('Quests')").parent().addClass('active');;
        $("#CreateQuest a:contains('Create Quest')").parent().addClass('active');;
        $("#Profile a:contains('Profile')").parent().addClass('active');
        $("#Inventory a:contains('Inventory')").parent().addClass('active');
});