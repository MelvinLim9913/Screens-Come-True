const headerTemplate = document.createElement('template');

headerTemplate.innerHTML = `
    <style>
        #wrapper {
            background-color: #000614;
            margin: auto;
            width: 100%;
        }
        #menu-bar {
            background-color: #001D3D;
            height: 184px;
        }
        #navigation-bar {
            font-size: 24px;
            font-weight: 800;
            color: #FFFFFF;
            position: absolute;
            width: 553px;
            height: 33px;
            left: 431px;
            top: 75px;
        }
        #login-register-section {
            background-color: #001D3D;
            border-style: solid;
            border-color: #FFC300;
            border-width: 1px;
            color: #FFFFFF;
            position: absolute;
            left: 1050px;
            top: 61px;
            width: 249px;
            height: 62px;
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            line-height: 63px;
            align-items: center;
            text-align: center;
        }
        header img {
            position: absolute;
            left: 50px;
            top: 35px;
        }
    </style>
    <header>
        <div id="menu-bar">
            <img src="../img/Screens%20Come%20True.png" width="280" height="126" alt="Logo">
                <nav>
                    <div id="navigation-bar">
                        <a><strong>Movies</strong></a> &nbsp;&nbsp;
                        <a><strong>Our Cinemas</strong></a> &nbsp;&nbsp;
                        <a><strong>Movies</strong></a> &nbsp;&nbsp;
                    </div>
                    <div id="login-register-section">
                        <a>Login</a>&nbsp;|&nbsp;<a>Register</a>
                    </div>
                </nav>
        </div>
    </header>
    `;

class Header extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        const shadowRoot = this.attachShadow({ mode: "closed" });
        shadowRoot.appendChild(headerTemplate.content);
    }
}

customElements.define('header-component', Header);