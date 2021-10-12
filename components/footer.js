const footerTemplate = document.createElement('template')

footerTemplate.innerHTML = `
    <style>
        #wrapper {
            background-color: #000000;
            color: #FFFFFF;
        }
        #footer {
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin: auto;
            min-width: 1000px;
        }
        #copyright {
            text-align: center;
            padding-top: 20px;
            padding-bottom: 5px;
            width: 80%;
            margin: auto;
            min-width: 1000px;
        }
        footer {
            background-color: #000000;
            color: #FFFFFF;
            min-width: 1000px;
        }
        a {
            font-family: Tahoma, Trebuchet MS;
            color: #FFFFFF;
            text-decoration: None;
        }
        a:hover {
            color: #EA2127;
            -moz-transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
            transition: all .3s ease-in;
        }
        #email-address {
            text-decoration: #FFFFFF;
        }
        .title {
            font-size: 20px
        }
        img {
            vertical-align: bottom;
        }
    </style>
    <footer>
        <div id="footer">
            <div id="movies">
                <img src="../img/footer_movie.png" alt="title" height="30" width="30">
                <a class="title"><strong>Movies</strong></a>
                <p><a>Now Showing</a><br><a>Coming Soon</a></p>
            </div>
            <div id="cinemas">
                <img src="../img/footer_cinema.png" alt="title" height="30" width="30">
                <a class="title"><strong>Cinemas</strong></a>
                <p><a>Discover Our Cinemas</a><br><a>Cinema Experience</a></p>
            </div>
            <div id="promotions">
            <img src="../img/footer_promotions.png" alt="title" height="30" width="30">
                <a class="title"><strong>Promotions</strong></a>
                <p><a>Food & Beverages</a><br><a>Merchandise</a></p>
            </div>
            <div id="support-us">
                <img src="../img/footer_support.png" alt="title" height="30" width="30">
                <a class="title"><strong>Support Us</strong></a>
                <p><a href="pages/feedback.html">Provide Feedback</a></p>
            </div>
            <div id="contact-us">
                <img src="../img/footer_contact.png" alt="title" height="30" width="30">
                <a class="title"><strong>Contact Us</strong></a>
                <p>Mobile Number: +65 8855 3311<br>Email Address: <a href="mailto:hello@cinema.com" class="email-address">hello@cinema.com</a></p>
            </div>
        </div>
        <div id="copyright">
            <small>Copyrights Reserved &copy; 2021 Screens Come True. All Rights Reserved.</small>
        </div>
    </footer>
    `;

class Footer extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        const shadowRoot = this.attachShadow({ mode: "closed" });
        shadowRoot.appendChild(footerTemplate.content);
    }
}

customElements.define('footer-component', Footer);