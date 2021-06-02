import { gsap } from 'gsap';

class CasestudyCollapse {

    constructor(){

        console.log('CasestudyCollapse')

        $('.casestudy').each(function (  ) {

            let button = $('.more-info', this)
            let content = $('.content', this)
            let open = false;

            button.click(function () {

                if (open) {
                    gsap.to(content, {height: 0})

                    open= false
                } else {
                    gsap.set(content, {height: 'auto'})
                    gsap.from(content, {height: 0})

                    open= true
                }

            });

        });
    }

}

export default CasestudyCollapse
