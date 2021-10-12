var headerTemplate_valid_user = document.createElement('template');

headerTemplate_valid_user.innerHTML = `
    <style>
        #menu-bar {
            background-color: #000000;
            height: 100px;
            display: flex;
            width: 80%;
            min-width: 1000px;
            margin: 0 auto;
            justify-content: space-between;
            align-items: center;
        }
        #navigation-bar {
            font-size: 20px;
            font-weight: 800;
            color: #FFFFFF;
            align-items: center;
        }
        ul {
            font-family: Tahoma, Trebuchet MS;
            letter-spacing: 0.05em;
            display: flex;
            justify-content: center;
            list-style-type: none;
        }
        li {
            margin-right: 60px;
        }
        a:hover {
            color: #EA2127;
            -moz-transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
            transition: all .3s ease-in;
        }
        a {
            text-decoration: none;
            color: #FFFFFF;
            font-weight: bold;
            font-family: Tahoma, Trebuchet MS;
            letter-spacing: 0.05em;
        }
        .login {
            font-weight: normal;
            transition: 0.3s all ease-in-out;
        }
        li a {
            -moz-transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
            transition: all .3s ease-in-out;
        }
        li a:after {    
          content: '';
          width: 0;
          height: 2px;
          background-color: #FFFFFF;
          margin: auto;
          display: block;
          transition: 0.3s all ease-in-out;
        }
        li a:hover:after { 
          width: 28px; 
          transition: width 0.3s ease-in-out;
        }
        header .header img {
            left: 50px;
            top: 35px;
            height: 80%;
            width: 250px;
            height: 100px;
            text-align: left;
            float: left;
        }
        header {
            justify-content: space-between;
            background-color: #000000;
            background-image: linear-gradient(180deg, #000000, #000000);
            }

        #validuser {
            cursor: pointer;
        }
            
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            font-weight: normal;
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-content a:hover {
            background-color: #EA2127;
            color: #FFFFFF;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

    </style>
    <header>
        <div id="menu-bar">
            <div class="header">
                <img src="img/header_title.png" alt="Logo">
            </div>
            <nav>
                <div id="navigation-bar">
                    <ul>
                        <li><a><strong>Movies</strong></a></li>
                        <li><a><strong>Our Cinemas</strong></a></li>
                        <li><a><strong>Promotions</strong></a></li>
                    </ul>
                </div>
            </nav>
            <div class="dropdown">
                <img id="validuser" src="img/valid_user.png" width="60" height="60"">   
                <div class="dropdown-content">
                    <a href="pages/feedback.html">Provide Feedback</a>
                    <a href="pages/signout.php">Sign Out</a>
                </div>
            </div>
                      
        </div>
    </header>
    `;

class HeaderValidUser extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        const shadowRoot = this.attachShadow({ mode: "closed" });
        shadowRoot.appendChild(headerTemplate_valid_user.content);
    }
}

customElements.define('header-component', HeaderValidUser);