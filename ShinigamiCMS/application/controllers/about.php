<?php

class About extends ShinigamiCMS\System\Core\Objectbase {
    
    public function Index() {
        $page_content = '
            <h2>About Me</h2>
            <p>My name is Shane McIntosh, but I am also known by various other nick names including BinaryShinigami, Mac, Digi and a few others.
            I am an avid PC gamer and as I hobby I like to develop software. The majority of my software is released under the Lagune Software group
            title which I am a co-founder of along with a good friend of mine called e0s.  You can check out his blog at <a href="http://voooid.com">voooid.com</a>.
            </p>
            <p>
            I enjoy flight sim and military sim games as well as the occasional RPG and run-and-gun shooter like CoD. I enjoy the DCS series of flight simulators and
            the ARMA game series as well as the Project Reality mod for Battlefield 2. You can often find me online playing one of those games if I am not
            working on code.
            </p>
            <p>
            Well I don\' really know what else there is that you would want to know about me. I\'ve been developing as a hobby for at least 5 years mostly with 
            PHP, Python and C though I will dabble in other languages for odd ball projects just to do something different. I am currently working on taking up
            free lance work on oDesk and you can view my oDesk profile <a href="https://www.odesk.com/o/profiles/users/_~01665d5c508507f03d/">here</a>.
            </p>
            <p>
            If you would like to see my CV or work you can check out the following places:
            <ul>
            <li><a href="http://careers.stackoverflow.com/shanemcintosh">My CV on careers.stackoverflow.com</a></li>
            <li><a href="https://github.com/BinaryShinigami">My projects on github</a></li>
            <li><a href="http://lagune-software.com">Lagune Software Releases</a></li>
            <li><a href="https://www.odesk.com/o/profiles/users/_~01665d5c508507f03d/">My oDesk Profile</a></li>
            </ul>
            <p>
            You can contact me via the following routes:
            <ul>
            <li>E-Mail: <a href="mailto:binary@lagune-software.com">binary@lagune-software.com</a></li>
            <li>E-Mail: <a href="mailto:shmcinto@gmail.com">shmcinto@gmail.com</a></li>
            <li>AIM: BinaryShinigami</li>
            <li>Steam: BinaryShinigami</li>
            <li>MSN: xero-tech@hotmail.com</li>
            </ul>
            </p>
        ';
        return $this->blog_layout->render_page($page_content);
        
    }
    
    
}

/* End of file */