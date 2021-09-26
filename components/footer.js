const footerTemplate = document.createElement('template')

footerTemplate.innerHTML = `
    <style>
        #wrapper {
            background-color: #000614;
            color: #FFFFFF;
        }
        #footer {
            padding-top: 10px;
            display: flex;
            justify-content: space-around;
        }
        #copyright {
            text-align: center;
            padding-top: 20px;
            padding-bottom: 5px;
        }
        footer {
            background-color: #001D3D;
            color: #FFFFFF;
        }
    </style>
    <footer>
        <div id="footer">
            <div id="movies">
                <a><strong>Movies</strong></a>
                <p><a>Now Showing</a><br><a>Coming Soon</a></p>
            </div>
            <div id="cinemas">
                <a><strong>Cinemas</strong></a>
                <p><a>Discover Our Cinemas</a><br><a>Cinema Experience</a></p>
            </div>
            <div id="promotions">
                <a><strong>Promotions</strong></a>
                <p><a>Food & Beverages</a><br><a>Merchandise</a></p>
            </div>
            <div id="support-us">
                <a><strong>Support Us</strong></a>
                <p><a>Provide Feedback</a></p>
            </div>
            <div id="contact-us">
                <a><strong>Contact Us</strong></a>
                <p>Mobile Number: +65 8855 3311<br><a>Email Address: hello@cinema.com</a></p>
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