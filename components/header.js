const headerTemplate = document.createElement('template');

headerTemplate.innerHTML = `
    <style>
        #wrapper {
            background-color: #000614;
            margin: auto;
            width: 80%;
            display: flex;
        }
        #menu-bar {
            background-color: #001D3D;
            height: 130px;
            display: flex;
            width: 80%;
            min-width: 1000px;
            margin: auto;
            justify-content: space-around;
            align-items: center;
        }
        #navigation-bar {
            font-size: 24px;
            font-weight: 800;
            color: #FFFFFF;
            align-items: center;
        }
        li {
            display: inline;
            letter-spacing: 0.1em;
        }
        a:hover {
            color: #FFC300;
        }
        li a:after {    
          background: none repeat scroll 0 0 transparent;
          bottom: 0;
          content: "";
          display: block;
          height: 2px;
          left: 50%;
          position: absolute;
          transition: width 0.3s ease 0s, left 0.3s ease 0s;
          width: 0;
        }
        li a:hover:after { 
          width: 100%; 
          left: 0; 
        }
        #login-register-section {
            background-color: #001D3D;
            border-style: solid;
            border-color: #FFC300;
            border-width: 1px;
            color: #FFFFFF;
            font-style: normal;
            font-weight: normal;
            font-size: 15px;
            line-height: 30px;
            align-items: center;
            text-align: center;
            height: 30px;
            width: 150px;
        }
        header img {
            left: 50px;
            top: 35px;
        }
        header {
            justify-content: space-between;
            background-color: #001D3D;
            }
    </style>
    <header>
        <div id="menu-bar">
            <img src="../img/Screens%20Come%20True.png" width="225" height="101" alt="Logo">
            <nav>
                <div id="navigation-bar">
                    <ul>
                        <li><a><strong>Movies</strong></a> &nbsp;&nbsp;</li>
                        <li><a><strong>Our Cinemas</strong></a> &nbsp;&nbsp;</li>
                        <li><a><strong>Promotions</strong></a> &nbsp;&nbsp;</li>
                    </ul>
                </div>
            </nav>
            <div id="login-register-section">
                <a>Log In</a>&nbsp;|&nbsp;<a>Register</a>
            </div>            
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