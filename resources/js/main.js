window.onload = function(){
    const elm = document.querySelectorAll('#section');
    const elmCount = elm.length;
    elm.forEach(function(item, index){
        item.addEventListener('mousewheel', function(event){
            event.preventDefault();
            let delta = 0;

            if (!event) event = window.event;
            if (event.wheelDelta) {
                delta = event.wheelDelta / 120;
                if (window.opera) delta = -delta;
            }
            else if (event.detail)
                delta = -event.detail / 3;

            let moveTop = window.scrollY;
            let elmSelector = elm[index];

            // wheel down : move to next section
            if (delta < 0){
                if (elmSelector !== elmCount-1){
                    try{
                        moveTop = window.pageYOffset + elmSelector.nextElementSibling.getBoundingClientRect().top;
                    }catch(e){}
                }
            }
            // wheel up : move to previous section
            else{
                if (elmSelector !== 0){
                    try{
                        moveTop = window.pageYOffset + elmSelector.previousElementSibling.getBoundingClientRect().top;
                    }catch(e){}
                }
            }

            const body = document.querySelector('html');
            window.scrollTo({top:moveTop, left:0, behavior:'smooth'});
        });
    });
}