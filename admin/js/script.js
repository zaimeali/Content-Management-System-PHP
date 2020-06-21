$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkBox').each(function(){
                this.checked = true;
            });
        }
        else{
            $('.checkBox').each(function(){
                this.checked = false;
            });
        }
    });
});