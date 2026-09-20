-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 20, 2026 at 10:41 AM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcopilotcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `key_articles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT '0',
  `document_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title_sub` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `article_snippet` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `article_content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `content_type` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content_direction` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ltr',
  `book_indent_level` tinyint(4) NOT NULL DEFAULT '0',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `show_on_home` tinyint(1) NOT NULL DEFAULT '1',
  `show_in_listing` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`key_articles`),
  KEY `fk_articles_media` (`key_media_banner`),
  KEY `entry_date_time` (`entry_date_time`),
  KEY `update_date_time` (`update_date_time`),
  KEY `is_active` (`is_active`),
  KEY `is_featured` (`is_featured`),
  KEY `document_code` (`document_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`key_articles`, `key_media_banner`, `document_code`, `title`, `title_sub`, `article_snippet`, `article_content`, `content_type`, `content_direction`, `book_indent_level`, `url`, `banner_image_url`, `sort`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`, `is_featured`, `show_on_home`, `show_in_listing`, `is_active`) VALUES
(1, 0, '', 'An Introduction to Javascript', '', '', '    <p>\r\n      JavaScript is one of the most important and widely used programming\r\n      languages in the world. Originally created to make web pages interactive,\r\n      JavaScript has evolved into a powerful, versatile language used for\r\n      websites, web applications, servers, mobile applications, desktop\r\n      software, games, and even artificial intelligence tools.\r\n    </p>\r\n\r\n  <section>\r\n    <h2>What Is JavaScript?</h2>\r\n\r\n    <p>\r\n      JavaScript is a high-level, interpreted programming language primarily\r\n      used to add interactivity and dynamic behavior to websites. While\r\n      <strong>HTML</strong> provides the structure of a web page and\r\n      <strong>CSS</strong> controls its appearance and presentation,\r\n      <strong>JavaScript</strong> provides much of the behavior and logic.\r\n    </p>\r\n\r\n    <p>\r\n      For example, HTML can create a button, CSS can make that button look\r\n      attractive, and JavaScript can determine what happens when a visitor\r\n      clicks it. JavaScript can display messages, validate forms, modify page\r\n      content, create animations, communicate with web servers, process data,\r\n      and respond to user actions.\r\n    </p>\r\n\r\n    <p>\r\n      JavaScript is commonly abbreviated as <strong>JS</strong>. Despite the\r\n      similarity in name, JavaScript is not the same programming language as\r\n      Java. They were developed independently and have different syntax,\r\n      concepts, and uses.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>A Brief History of JavaScript</h2>\r\n\r\n    <p>\r\n      JavaScript was created in 1995 by <strong>Brendan Eich</strong> while he\r\n      was working at Netscape Communications. The original goal was to create\r\n      a scripting language that could be used within web browsers to make\r\n      web pages more interactive.\r\n    </p>\r\n\r\n    <p>\r\n      The language was initially developed under the name\r\n      <strong>Mocha</strong>. It was later called <strong>LiveScript</strong>\r\n      and eventually JavaScript. The name was influenced by the popularity of\r\n      Java at the time, although JavaScript itself was not derived from Java.\r\n    </p>\r\n\r\n    <p>\r\n      As web development grew, different browsers began implementing\r\n      JavaScript in their own ways. To promote consistency, JavaScript was\r\n      standardized through <strong>ECMAScript</strong>, a specification\r\n      maintained by <strong>ECMA International</strong>.\r\n    </p>\r\n\r\n    <p>\r\n      Modern JavaScript is therefore closely associated with the ECMAScript\r\n      standard. New versions of the standard have introduced features that\r\n      have made JavaScript more powerful, readable, and suitable for\r\n      large-scale software development.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Why Is JavaScript Important?</h2>\r\n\r\n    <p>\r\n      JavaScript occupies a unique position in web development because it is\r\n      supported directly by modern web browsers. A browser can execute\r\n      JavaScript without requiring the visitor to install a separate\r\n      programming environment.\r\n    </p>\r\n\r\n    <p>\r\n      Almost every modern interactive website makes use of JavaScript in some\r\n      form. From simple menus and image sliders to sophisticated online\r\n      applications such as email clients, productivity tools, online editors,\r\n      dashboards, and e-commerce platforms, JavaScript plays a major role.\r\n    </p>\r\n\r\n    <p>\r\n      Another important reason for JavaScript\'s popularity is its ability to\r\n      operate on both the <strong>client side</strong> and the\r\n      <strong>server side</strong>. Technologies such as\r\n      <strong>Node.js</strong> allow developers to use JavaScript outside the\r\n      browser, particularly for server-side applications.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>JavaScript and HTML</h2>\r\n\r\n    <p>\r\n      HTML and JavaScript serve different purposes, but they work closely\r\n      together. HTML defines the elements that appear on a web page, while\r\n      JavaScript can interact with those elements and change them while the\r\n      page is being displayed.\r\n    </p>\r\n\r\n    <p>\r\n      Consider a simple button:\r\n    </p>\r\n\r\n    <pre><code>&lt;button id=\"welcomeButton\"&gt;Click Me&lt;/button&gt;</code></pre>\r\n\r\n    <p>\r\n      JavaScript can respond when the visitor clicks the button:\r\n    </p>\r\n\r\n    <pre><code>document.getElementById(\"welcomeButton\").addEventListener(\"click\", function () {\r\n  alert(\"Welcome to JavaScript!\");\r\n});</code></pre>\r\n\r\n    <p>\r\n      In this example, HTML creates the button, while JavaScript adds the\r\n      behavior that occurs when the button is clicked.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>JavaScript and CSS</h2>\r\n\r\n    <p>\r\n      JavaScript can also work with CSS to change the appearance of a web page\r\n      dynamically. For example, JavaScript can add or remove CSS classes,\r\n      change styles, hide elements, display elements, or modify the layout\r\n      according to user interaction.\r\n    </p>\r\n\r\n    <p>\r\n      This combination of HTML, CSS, and JavaScript forms the foundation of\r\n      modern front-end web development.\r\n    </p>\r\n\r\n    <ul>\r\n      <li><strong>HTML</strong> â€” Defines the structure and content.</li>\r\n      <li><strong>CSS</strong> â€” Defines presentation and visual appearance.</li>\r\n      <li><strong>JavaScript</strong> â€” Adds behavior, interaction, and logic.</li>\r\n    </ul>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Where Does JavaScript Run?</h2>\r\n\r\n    <p>\r\n      JavaScript can run in several different environments. The most familiar\r\n      environment is the web browser, where JavaScript is executed by a\r\n      JavaScript engine.\r\n    </p>\r\n\r\n    <h3>1. Web Browsers</h3>\r\n\r\n    <p>\r\n      Browsers such as Chrome, Edge, Firefox, Safari, and others contain\r\n      JavaScript engines capable of executing JavaScript code.\r\n    </p>\r\n\r\n    <p>\r\n      Browser-based JavaScript can interact with the web page through the\r\n      <strong>Document Object Model (DOM)</strong>, respond to user actions,\r\n      communicate with servers, and perform many other tasks.\r\n    </p>\r\n\r\n    <h3>2. Servers</h3>\r\n\r\n    <p>\r\n      JavaScript can also run on servers using environments such as\r\n      <strong>Node.js</strong>. Server-side JavaScript can handle requests,\r\n      communicate with databases, authenticate users, process files, and\r\n      provide APIs for applications.\r\n    </p>\r\n\r\n    <h3>3. Other Platforms</h3>\r\n\r\n    <p>\r\n      JavaScript is no longer restricted to traditional web pages. Modern\r\n      frameworks and runtime environments allow developers to use JavaScript\r\n      for mobile applications, desktop applications, command-line programs,\r\n      games, and many other types of software.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Basic JavaScript Syntax</h2>\r\n\r\n    <p>\r\n      JavaScript syntax is the set of rules used to write JavaScript programs.\r\n      A very simple JavaScript statement might look like this:\r\n    </p>\r\n\r\n    <pre><code>console.log(\"Hello, World!\");</code></pre>\r\n\r\n    <p>\r\n      The <code>console.log()</code> function displays information in the\r\n      browser\'s developer console or the console of another JavaScript\r\n      environment.\r\n    </p>\r\n\r\n    <p>\r\n      JavaScript statements can be written one after another to create a\r\n      sequence of instructions:\r\n    </p>\r\n\r\n    <pre><code>let name = \"Ahmed\";\r\nlet age = 25;\r\n\r\nconsole.log(name);\r\nconsole.log(age);</code></pre>\r\n\r\n    <p>\r\n      JavaScript is generally case-sensitive. This means that\r\n      <code>name</code>, <code>Name</code>, and <code>NAME</code> can represent\r\n      different identifiers.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Variables in JavaScript</h2>\r\n\r\n    <p>\r\n      Variables are used to store data that a program may need to use or\r\n      manipulate. Modern JavaScript provides three main keywords for declaring\r\n      variables: <code>let</code>, <code>const</code>, and the older\r\n      <code>var</code>.\r\n    </p>\r\n\r\n    <h3>The <code>let</code> Keyword</h3>\r\n\r\n    <p>\r\n      The <code>let</code> keyword is commonly used when the value of a\r\n      variable may change.\r\n    </p>\r\n\r\n    <pre><code>let score = 10;\r\nscore = 20;</code></pre>\r\n\r\n    <h3>The <code>const</code> Keyword</h3>\r\n\r\n    <p>\r\n      The <code>const</code> keyword is used when a variable should not be\r\n      reassigned after its initial value has been provided.\r\n    </p>\r\n\r\n    <pre><code>const country = \"Pakistan\";</code></pre>\r\n\r\n    <p>\r\n      In modern JavaScript, developers generally prefer <code>const</code>\r\n      by default and use <code>let</code> when reassignment is necessary.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Data Types in JavaScript</h2>\r\n\r\n    <p>\r\n      JavaScript supports several types of data. Some of the most commonly\r\n      encountered data types include:\r\n    </p>\r\n\r\n    <ul>\r\n      <li><strong>String</strong> â€” Textual data.</li>\r\n      <li><strong>Number</strong> â€” Numeric values.</li>\r\n      <li><strong>Boolean</strong> â€” <code>true</code> or <code>false</code>.</li>\r\n      <li><strong>Undefined</strong> â€” A variable that has not been assigned a value.</li>\r\n      <li><strong>Null</strong> â€” Represents an intentional absence of a value.</li>\r\n      <li><strong>Object</strong> â€” A collection of related data and functionality.</li>\r\n      <li><strong>Symbol</strong> â€” A unique primitive value.</li>\r\n      <li><strong>BigInt</strong> â€” Used for very large integer values.</li>\r\n    </ul>\r\n\r\n    <p>\r\n      Examples:\r\n    </p>\r\n\r\n    <pre><code>let name = \"Ali\";          // String\r\nlet age = 30;              // Number\r\nlet isStudent = true;      // Boolean\r\nlet address;               // Undefined\r\nlet result = null;         // Null</code></pre>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Operators</h2>\r\n\r\n    <p>\r\n      Operators allow JavaScript programs to perform calculations, comparisons,\r\n      assignments, and logical operations.\r\n    </p>\r\n\r\n    <p>\r\n      Arithmetic operators include:\r\n    </p>\r\n\r\n    <pre><code>let a = 10;\r\nlet b = 3;\r\n\r\nconsole.log(a + b); // Addition\r\nconsole.log(a - b); // Subtraction\r\nconsole.log(a * b); // Multiplication\r\nconsole.log(a / b); // Division\r\nconsole.log(a % b); // Remainder</code></pre>\r\n\r\n    <p>\r\n      JavaScript also provides comparison operators such as\r\n      <code>===</code>, <code>!==</code>, <code>&gt;</code>,\r\n      <code>&lt;</code>, <code>&gt;=</code>, and <code>&lt;=</code>.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Conditional Statements</h2>\r\n\r\n    <p>\r\n      Programs frequently need to make decisions. JavaScript provides\r\n      conditional statements for this purpose.\r\n    </p>\r\n\r\n    <pre><code>let age = 20;\r\n\r\nif (age &gt;= 18) {\r\n  console.log(\"You are an adult.\");\r\n} else {\r\n  console.log(\"You are a minor.\");\r\n}</code></pre>\r\n\r\n    <p>\r\n      JavaScript also provides the <code>else if</code> construct for checking\r\n      multiple conditions.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Loops</h2>\r\n\r\n    <p>\r\n      Loops allow a program to repeat a set of instructions. JavaScript\r\n      supports several types of loops, including <code>for</code>,\r\n      <code>while</code>, and <code>do...while</code>.\r\n    </p>\r\n\r\n    <p>\r\n      A simple <code>for</code> loop looks like this:\r\n    </p>\r\n\r\n    <pre><code>for (let i = 1; i &lt;= 5; i++) {\r\n  console.log(i);\r\n}</code></pre>\r\n\r\n    <p>\r\n      The loop above prints the numbers from 1 through 5.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Functions</h2>\r\n\r\n    <p>\r\n      A function is a reusable block of code designed to perform a particular\r\n      task. Functions help developers organize programs and avoid unnecessary\r\n      repetition.\r\n    </p>\r\n\r\n    <pre><code>function greet(name) {\r\n  return \"Hello, \" + name + \"!\";\r\n}\r\n\r\nconsole.log(greet(\"Ahmed\"));</code></pre>\r\n\r\n    <p>\r\n      Modern JavaScript also supports arrow functions, which provide a concise\r\n      syntax:\r\n    </p>\r\n\r\n    <pre><code>const greet = (name) =&gt; {\r\n  return `Hello, ${name}!`;\r\n};</code></pre>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Arrays</h2>\r\n\r\n    <p>\r\n      Arrays are used to store multiple values in a single variable.\r\n    </p>\r\n\r\n    <pre><code>const fruits = [\"Apple\", \"Banana\", \"Orange\"];\r\n\r\nconsole.log(fruits[0]);\r\nconsole.log(fruits[1]);</code></pre>\r\n\r\n    <p>\r\n      JavaScript provides many built-in methods for working with arrays,\r\n      including <code>push()</code>, <code>pop()</code>, <code>map()</code>,\r\n      <code>filter()</code>, <code>find()</code>, and <code>reduce()</code>.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Objects</h2>\r\n\r\n    <p>\r\n      Objects allow developers to group related information together using\r\n      properties and values.\r\n    </p>\r\n\r\n    <pre><code>const person = {\r\n  name: \"Ahmed\",\r\n  age: 30,\r\n  country: \"Pakistan\"\r\n};\r\n\r\nconsole.log(person.name);\r\nconsole.log(person.age);</code></pre>\r\n\r\n    <p>\r\n      Objects are fundamental to JavaScript and are used extensively in both\r\n      small scripts and large applications.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>The Document Object Model (DOM)</h2>\r\n\r\n    <p>\r\n      One of the most important concepts for browser-based JavaScript is the\r\n      <strong>Document Object Model</strong>, commonly known as the\r\n      <strong>DOM</strong>.\r\n    </p>\r\n\r\n    <p>\r\n      The DOM represents an HTML document as a structure of objects. JavaScript\r\n      can use the DOM to find HTML elements, change their content, modify\r\n      attributes, change styles, create new elements, remove existing elements,\r\n      and respond to user interaction.\r\n    </p>\r\n\r\n    <p>\r\n      For example, suppose an HTML page contains:\r\n    </p>\r\n\r\n    <pre><code>&lt;h1 id=\"title\"&gt;Original Heading&lt;/h1&gt;</code></pre>\r\n\r\n    <p>\r\n      JavaScript can change the heading:\r\n    </p>\r\n\r\n    <pre><code>document.getElementById(\"title\").textContent = \"New Heading\";</code></pre>\r\n\r\n    <p>\r\n      This ability to manipulate a page dynamically is one of the main reasons\r\n      JavaScript became essential to modern web development.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Events in JavaScript</h2>\r\n\r\n    <p>\r\n      Web pages constantly respond to events. An event may occur when a user\r\n      clicks a button, moves a mouse, presses a key, submits a form, or when\r\n      the page finishes loading.\r\n    </p>\r\n\r\n    <p>\r\n      JavaScript can listen for these events and execute appropriate code.\r\n    </p>\r\n\r\n    <pre><code>const button = document.getElementById(\"myButton\");\r\n\r\nbutton.addEventListener(\"click\", function () {\r\n  console.log(\"The button was clicked.\");\r\n});</code></pre>\r\n\r\n    <p>\r\n      Event handling is a fundamental part of creating interactive websites\r\n      and web applications.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Asynchronous JavaScript</h2>\r\n\r\n    <p>\r\n      Some operations take time to complete. For example, a web application\r\n      may need to retrieve information from a server. JavaScript provides\r\n      mechanisms for handling such operations without unnecessarily blocking\r\n      the rest of the application.\r\n    </p>\r\n\r\n    <p>\r\n      Important concepts in asynchronous JavaScript include\r\n      <strong>callbacks</strong>, <strong>Promises</strong>, and\r\n      <strong>async/await</strong>.\r\n    </p>\r\n\r\n    <p>\r\n      A modern example using <code>async</code> and <code>await</code> might\r\n      look like this:\r\n    </p>\r\n\r\n    <pre><code>async function getData() {\r\n  const response = await fetch(\"https://example.com/data\");\r\n  const data = await response.json();\r\n\r\n  console.log(data);\r\n}</code></pre>\r\n\r\n    <p>\r\n      Asynchronous programming makes it possible to build applications that\r\n      communicate with remote servers and perform other time-consuming\r\n      operations while remaining responsive.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>JavaScript and APIs</h2>\r\n\r\n    <p>\r\n      An <strong>API (Application Programming Interface)</strong> allows\r\n      different software systems to communicate with each other.\r\n    </p>\r\n\r\n    <p>\r\n      JavaScript applications frequently communicate with web APIs to retrieve\r\n      or submit information. For example, a weather application might request\r\n      weather data from a remote API and then display the results on the page.\r\n    </p>\r\n\r\n    <p>\r\n      The <code>fetch()</code> API provides a common way of making HTTP\r\n      requests from JavaScript:\r\n    </p>\r\n\r\n    <pre><code>fetch(\"https://example.com/api/data\")\r\n  .then(response =&gt; response.json())\r\n  .then(data =&gt; {\r\n    console.log(data);\r\n  })\r\n  .catch(error =&gt; {\r\n    console.error(error);\r\n  });</code></pre>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>JavaScript Frameworks and Libraries</h2>\r\n\r\n    <p>\r\n      As web applications became increasingly sophisticated, developers began\r\n      creating libraries and frameworks to simplify application development.\r\n    </p>\r\n\r\n    <p>\r\n      Some well-known technologies in the JavaScript ecosystem include\r\n      <strong>React</strong>, <strong>Angular</strong>, <strong>Vue</strong>,\r\n      and <strong>Svelte</strong>. These tools provide different approaches\r\n      to building modern user interfaces and applications.\r\n    </p>\r\n\r\n    <p>\r\n      It is important for beginners to understand that these technologies are\r\n      not replacements for JavaScript itself. They are built around JavaScript\r\n      and rely on knowledge of the underlying language.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>JavaScript on the Server with Node.js</h2>\r\n\r\n    <p>\r\n      Traditionally, JavaScript was primarily associated with web browsers.\r\n      The introduction of <strong>Node.js</strong> made it possible to execute\r\n      JavaScript outside the browser.\r\n    </p>\r\n\r\n    <p>\r\n      Node.js is a JavaScript runtime environment that allows developers to\r\n      build server-side applications and other software using JavaScript.\r\n    </p>\r\n\r\n    <p>\r\n      With Node.js, developers can create web servers, APIs, command-line\r\n      applications, real-time systems, and many other types of software.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Object-Oriented and Functional Programming</h2>\r\n\r\n    <p>\r\n      JavaScript supports multiple programming styles. It can be used for\r\n      object-oriented programming, functional programming, procedural\r\n      programming, and combinations of these approaches.\r\n    </p>\r\n\r\n    <p>\r\n      JavaScript\'s object model is based on <strong>prototypes</strong>.\r\n      Modern JavaScript also provides the <code>class</code> syntax, which\r\n      offers a familiar way to define objects and their behavior.\r\n    </p>\r\n\r\n    <p>\r\n      Functional programming concepts such as higher-order functions,\r\n      immutability, and functions such as <code>map()</code>,\r\n      <code>filter()</code>, and <code>reduce()</code> are also widely used\r\n      in modern JavaScript development.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Advantages of JavaScript</h2>\r\n\r\n    <p>\r\n      JavaScript offers several advantages that have contributed to its\r\n      widespread adoption.\r\n    </p>\r\n\r\n    <ul>\r\n      <li>\r\n        <strong>Runs in browsers:</strong> JavaScript is supported by virtually\r\n        all modern web browsers.\r\n      </li>\r\n      <li>\r\n        <strong>Interactive web pages:</strong> It enables dynamic and\r\n        interactive user experiences.\r\n      </li>\r\n      <li>\r\n        <strong>Versatility:</strong> JavaScript can be used for both front-end\r\n        and back-end development.\r\n      </li>\r\n      <li>\r\n        <strong>Large ecosystem:</strong> Thousands of libraries, frameworks,\r\n        tools, and packages are available.\r\n      </li>\r\n      <li>\r\n        <strong>Large developer community:</strong> There is an enormous amount\r\n        of documentation, tutorials, examples, and community support.\r\n      </li>\r\n      <li>\r\n        <strong>Cross-platform development:</strong> JavaScript can be used to\r\n        build software for different platforms.\r\n      </li>\r\n      <li>\r\n        <strong>Relatively accessible:</strong> Beginners can start writing\r\n        JavaScript with nothing more than a web browser and a text editor.\r\n      </li>\r\n    </ul>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Limitations and Challenges</h2>\r\n\r\n    <p>\r\n      Despite its many advantages, JavaScript also has challenges. Its\r\n      flexibility can sometimes lead to confusing behavior for beginners,\r\n      particularly when learning concepts such as type coercion, scope,\r\n      closures, asynchronous programming, and the prototype system.\r\n    </p>\r\n\r\n    <p>\r\n      Large JavaScript projects can also become difficult to maintain without\r\n      good architecture, testing, documentation, and development practices.\r\n      The enormous ecosystem of frameworks and tools can sometimes be\r\n      overwhelming for newcomers.\r\n    </p>\r\n\r\n    <p>\r\n      These challenges can be managed by learning the language fundamentals\r\n      before moving on to advanced frameworks and libraries.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>JavaScript Security</h2>\r\n\r\n    <p>\r\n      JavaScript is a powerful technology, and with that power comes\r\n      responsibility. Web developers need to consider security when processing\r\n      user input, communicating with servers, handling authentication, and\r\n      manipulating HTML.\r\n    </p>\r\n\r\n    <p>\r\n      Developers should be particularly aware of vulnerabilities such as\r\n      <strong>Cross-Site Scripting (XSS)</strong>, insecure handling of user\r\n      input, and unsafe manipulation of web content.\r\n    </p>\r\n\r\n    <p>\r\n      Security should be considered from the beginning of a project rather\r\n      than treated as an afterthought.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>How to Start Learning JavaScript</h2>\r\n\r\n    <p>\r\n      One of the best things about learning JavaScript is that you can begin\r\n      with very simple tools. A modern web browser and a text editor are enough\r\n      to write and execute basic JavaScript programs.\r\n    </p>\r\n\r\n    <p>\r\n      Beginners should first learn the fundamentals of the language rather\r\n      than immediately jumping into sophisticated frameworks. A useful\r\n      progression is:\r\n    </p>\r\n\r\n    <ol>\r\n      <li>Learn basic JavaScript syntax.</li>\r\n      <li>Understand variables and data types.</li>\r\n      <li>Learn operators and expressions.</li>\r\n      <li>Practice conditional statements.</li>\r\n      <li>Learn loops.</li>\r\n      <li>Understand functions.</li>\r\n      <li>Study arrays and objects.</li>\r\n      <li>Learn DOM manipulation.</li>\r\n      <li>Learn event handling.</li>\r\n      <li>Study asynchronous programming and Promises.</li>\r\n      <li>Learn how JavaScript communicates with APIs.</li>\r\n      <li>Build small projects.</li>\r\n      <li>Move on to frameworks and advanced tools.</li>\r\n    </ol>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Simple JavaScript Example</h2>\r\n\r\n    <p>\r\n      The following example demonstrates how JavaScript can interact with HTML:\r\n    </p>\r\n\r\n    <pre><code>&lt;!DOCTYPE html&gt;\r\n&lt;html lang=\"en\"&gt;\r\n&lt;head&gt;\r\n  &lt;meta charset=\"UTF-8\"&gt;\r\n  &lt;title&gt;JavaScript Example&lt;/title&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n  &lt;h1 id=\"message\"&gt;Hello!&lt;/h1&gt;\r\n  &lt;button id=\"changeButton\"&gt;Change Message&lt;/button&gt;\r\n\r\n  &lt;script&gt;\r\n    const button = document.getElementById(\"changeButton\");\r\n    const message = document.getElementById(\"message\");\r\n\r\n    button.addEventListener(\"click\", function () {\r\n      message.textContent = \"JavaScript is working!\";\r\n    });\r\n  &lt;/script&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;</code></pre>\r\n\r\n    <p>\r\n      When the button is clicked, JavaScript finds the heading and changes its\r\n      text. Although this is a very small example, it demonstrates the basic\r\n      principle behind many interactive web applications.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>JavaScript in Modern Web Development</h2>\r\n\r\n    <p>\r\n      Modern web applications can be remarkably sophisticated. Applications\r\n      that once required desktop software can now run directly inside a web\r\n      browser. JavaScript is a major reason this transformation has been\r\n      possible.\r\n    </p>\r\n\r\n    <p>\r\n      JavaScript can work with databases through server-side technologies,\r\n      communicate with APIs, process information, update interfaces without\r\n      reloading entire pages, handle real-time communication, and interact\r\n      with numerous browser capabilities.\r\n    </p>\r\n\r\n    <p>\r\n      The JavaScript ecosystem has also expanded beyond traditional websites.\r\n      Developers can use JavaScript-based technologies to create mobile\r\n      applications, desktop applications, server applications, browser\r\n      extensions, games, and other forms of software.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>JavaScript vs. Java</h2>\r\n\r\n    <p>\r\n      A common beginner misconception is that JavaScript is a version of Java.\r\n      This is incorrect.\r\n    </p>\r\n\r\n    <p>\r\n      <strong>Java</strong> and <strong>JavaScript</strong> are separate\r\n      programming languages with different histories, designs, and typical\r\n      uses. Java is widely used for enterprise software, Android development,\r\n      large-scale backend systems, and other applications, while JavaScript\r\n      became particularly important in web development and later expanded to\r\n      many other environments.\r\n    </p>\r\n\r\n    <p>\r\n      Their names may be similar, but learning one does not mean that you have\r\n      learned the other.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>The Future of JavaScript</h2>\r\n\r\n    <p>\r\n      JavaScript continues to evolve as web technologies advance. The\r\n      ECMAScript standard continues to introduce improvements to the language,\r\n      while browsers and JavaScript runtimes continue to improve performance\r\n      and capabilities.\r\n    </p>\r\n\r\n    <p>\r\n      At the same time, the boundaries between web applications, desktop\r\n      applications, mobile applications, and server software continue to\r\n      become less distinct. JavaScript\'s ability to operate across many of\r\n      these environments makes it likely to remain an important programming\r\n      language for years to come.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>Conclusion</h2>\r\n\r\n    <p>\r\n      JavaScript began as a relatively small scripting language intended to\r\n      make web pages more interactive. Over the years, it has grown into one\r\n      of the world\'s most widely used programming languages.\r\n    </p>\r\n\r\n    <p>\r\n      Its importance comes not only from its role in web browsers but also\r\n      from its versatility. JavaScript can manipulate web pages, respond to\r\n      user actions, communicate with APIs, process data, run on servers, and\r\n      power applications across multiple platforms.\r\n    </p>\r\n\r\n    <p>\r\n      For anyone interested in web development, JavaScript is an essential\r\n      technology to learn. HTML provides the structure of a web page, CSS\r\n      provides its visual presentation, and JavaScript brings the page to\r\n      life through logic, interaction, and dynamic behavior.\r\n    </p>\r\n\r\n    <p>\r\n      The best way to learn JavaScript is through practice. Start with small\r\n      programs, experiment with the language, build simple web projects, and\r\n      gradually progress toward more advanced concepts. Once the fundamentals\r\n      are understood, frameworks, libraries, APIs, and larger application\r\n      architectures become much easier to understand.\r\n    </p>\r\n  </section>\r\n', '', 'ltr', 0, 'an-introduction-to-javascript', '', 0, '2026-09-05 01:49:44', '2026-09-05 01:51:10', 1, 1, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `article_authors`
--

DROP TABLE IF EXISTS `article_authors`;
CREATE TABLE IF NOT EXISTS `article_authors` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_authors` int(10) UNSIGNED NOT NULL,
  `article_work_label` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `key_articles` (`key_articles`),
  KEY `key_authors` (`key_authors`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

DROP TABLE IF EXISTS `article_categories`;
CREATE TABLE IF NOT EXISTS `article_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_articles`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_content_types`
--

DROP TABLE IF EXISTS `article_content_types`;
CREATE TABLE IF NOT EXISTS `article_content_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_content_types` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_articles`,`key_content_types`),
  KEY `key_content_types` (`key_content_types`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_tags`
--

DROP TABLE IF EXISTS `article_tags`;
CREATE TABLE IF NOT EXISTS `article_tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_tags` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_articles`,`key_tags`),
  KEY `key_tags` (`key_tags`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_workers`
--

DROP TABLE IF EXISTS `article_workers`;
CREATE TABLE IF NOT EXISTS `article_workers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_workers` int(10) UNSIGNED NOT NULL,
  `article_work_label` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `key_articles` (`key_articles`),
  KEY `key_workers` (`key_workers`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `key_authors` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `website` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media1` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media2` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media3` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `state` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '',
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_authors`),
  KEY `fk_authors_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE IF NOT EXISTS `blocks` (
  `key_blocks` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `key_photo_gallery` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `key_content_types` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `key_categories` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `key_tags` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `module_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `block_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `css` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `number_of_records` smallint(3) NOT NULL DEFAULT '0',
  `visible_on` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'desktop,mobile',
  `block_content` varchar(10000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show_on_pages` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show_in_region` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updated_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_dynamic` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`key_blocks`),
  KEY `fk_blocks_media` (`key_media_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`key_blocks`, `key_media_banner`, `key_photo_gallery`, `key_content_types`, `key_categories`, `key_tags`, `module_file`, `block_name`, `title`, `css`, `number_of_records`, `visible_on`, `block_content`, `show_on_pages`, `show_in_region`, `entry_date_time`, `created_by`, `updated_by`, `sort`, `is_dynamic`, `is_active`) VALUES
(1, 0, 0, 0, 0, 0, '', 'Footer Message', '', '', 5, 'large-desktop,desktop,tablet,mobile', '&copy; www.mywebsite.com', '', 'footer', '2026-09-20 15:33:08', 1, 0, 0, 0, 1),
(2, 0, 0, 0, 0, 0, 'content_types_55448', 'Content Types', 'Content Types', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_right', '2026-09-20 15:33:53', 1, 0, 0, 0, 1),
(3, 0, 0, 0, 0, 0, 'categories_55448', 'Categories', 'Categories', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_right', '2026-09-20 15:34:45', 1, 0, 0, 0, 1),
(5, 0, 0, 0, 0, 0, 'search6545645', 'Search', 'Search', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_left', '2026-09-20 15:36:05', 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `key_books` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `subtitle` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `author_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `publisher` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `publish_year` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `isbn` varchar(17) COLLATE utf8_unicode_ci DEFAULT '',
  `is_featured` tinyint(1) DEFAULT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `format` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight_grams` int(11) DEFAULT NULL,
  `sku` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_books`),
  KEY `fk_books_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_articles`
--

DROP TABLE IF EXISTS `book_articles`;
CREATE TABLE IF NOT EXISTS `book_articles` (
  `key_book_articles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_books` int(10) UNSIGNED NOT NULL,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `sort_order` int(5) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`key_book_articles`),
  UNIQUE KEY `unique_pair` (`key_books`,`key_articles`),
  KEY `key_articles` (`key_articles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

DROP TABLE IF EXISTS `book_categories`;
CREATE TABLE IF NOT EXISTS `book_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_books` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_books`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `key_categories` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_type` enum('article','book','photo_gallery','video_gallery','global') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'global',
  PRIMARY KEY (`key_categories`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`key_categories`, `key_media_banner`, `name`, `description`, `url`, `banner_image_url`, `sort`, `is_active`, `entry_date_time`, `category_type`) VALUES
(1, 0, 'Category 1', '', 'category-1', '', 0, 1, '2026-09-20 15:31:33', 'article'),
(2, 0, 'Category 2', '', 'category-2', '', 0, 1, '2026-09-20 15:31:41', 'article'),
(3, 0, 'Category 3', '', 'category-3', '', 0, 1, '2026-09-20 15:31:49', 'article');

-- --------------------------------------------------------

--
-- Table structure for table `content_types`
--

DROP TABLE IF EXISTS `content_types`;
CREATE TABLE IF NOT EXISTS `content_types` (
  `key_content_types` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_content_types`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content_types`
--

INSERT INTO `content_types` (`key_content_types`, `key_media_banner`, `name`, `description`, `url`, `banner_image_url`, `sort`, `is_active`, `entry_date_time`) VALUES
(1, 0, 'Content Type 1', '', 'content-type-1', '', 0, 1, '2026-09-20 15:31:03'),
(2, 0, 'Content Type 2', '', 'content-type-2', '', 0, 1, '2026-09-20 15:31:10'),
(3, 0, 'Content Type 3', '', 'content-type-3', '', 0, 1, '2026-09-20 15:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

DROP TABLE IF EXISTS `fonts`;
CREATE TABLE IF NOT EXISTS `fonts` (
  `key_fonts` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `font_label` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `file_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`key_fonts`),
  UNIQUE KEY `font_label` (`font_label`),
  UNIQUE KEY `file_name` (`file_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE IF NOT EXISTS `main_menu` (
  `key_main_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `css_class` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_main_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`key_main_menu`, `parent_id`, `title`, `url_link`, `css_class`, `sort`, `is_active`, `entry_date_time`) VALUES
(1, 0, 'Home', 'https://copilotcms.org', '', 0, 1, '2026-09-20 15:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `media_library`
--

DROP TABLE IF EXISTS `media_library`;
CREATE TABLE IF NOT EXISTS `media_library` (
  `key_media` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `file_url_thumbnail` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `file_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images',
  `alt_text` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `uploaded_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_media`),
  KEY `uploaded_by` (`uploaded_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `key_pages` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `page_content` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_pages`),
  KEY `fk_pages_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_categories`
--

DROP TABLE IF EXISTS `photo_categories`;
CREATE TABLE IF NOT EXISTS `photo_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_photo_gallery` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_photo_gallery`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery`
--

DROP TABLE IF EXISTS `photo_gallery`;
CREATE TABLE IF NOT EXISTS `photo_gallery` (
  `key_photo_gallery` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `available_for_blocks` tinyint(1) DEFAULT '0',
  `css` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `slideshow_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `navigation_type` enum('arrows','slideshow','both','none') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'slideshow',
  PRIMARY KEY (`key_photo_gallery`),
  KEY `fk_photo_gallery_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery_images`
--

DROP TABLE IF EXISTS `photo_gallery_images`;
CREATE TABLE IF NOT EXISTS `photo_gallery_images` (
  `key_image` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `key_photo_gallery` int(10) UNSIGNED NOT NULL,
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image_mobile_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opacity` float DEFAULT '1',
  `action_button` tinyint(1) DEFAULT '0',
  `action_button_text` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_button_link_url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `animation_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'fade',
  `text_position` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'center',
  `text_color` varchar(20) COLLATE utf8_unicode_ci DEFAULT '#ffffff',
  `image_wrapper_class` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `visibility_start` datetime DEFAULT NULL,
  `visibility_end` datetime DEFAULT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`key_image`),
  KEY `key_photo_gallery` (`key_photo_gallery`),
  KEY `fk_photo_gallery_images_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `key_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_type` enum('book','stationery','digital','other') COLLATE utf8_unicode_ci NOT NULL,
  `key_books` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `discount_percent` tinyint(4) DEFAULT NULL,
  `sku` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) DEFAULT '1',
  `sort` smallint(6) DEFAULT NULL,
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_product` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `key_image` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `key_product` int(10) UNSIGNED NOT NULL,
  `sort_order` smallint(5) UNSIGNED DEFAULT '0',
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_image`),
  KEY `key_product` (`key_product`),
  KEY `fk_product_images_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

DROP TABLE IF EXISTS `product_orders`;
CREATE TABLE IF NOT EXISTS `product_orders` (
  `key_order` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`key_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_order_items`
--

DROP TABLE IF EXISTS `product_order_items`;
CREATE TABLE IF NOT EXISTS `product_order_items` (
  `key_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_order` int(10) UNSIGNED DEFAULT NULL,
  `key_product` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`key_item`),
  KEY `key_order` (`key_order`),
  KEY `key_product` (`key_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_prices_history`
--

DROP TABLE IF EXISTS `product_prices_history`;
CREATE TABLE IF NOT EXISTS `product_prices_history` (
  `key_price` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_product` int(10) UNSIGNED NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `new_price` decimal(10,2) DEFAULT NULL,
  `change_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `key_settings` int(10) NOT NULL DEFAULT '0',
  `template_folder` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `custom_css` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`key_settings`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key_settings`, `template_folder`, `custom_css`) VALUES
(1, 'default', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings_key_value`
--

DROP TABLE IF EXISTS `settings_key_value`;
CREATE TABLE IF NOT EXISTS `settings_key_value` (
  `key_settings` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8_unicode_ci NOT NULL,
  `setting_group` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'general',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_settings`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings_key_value`
--

INSERT INTO `settings_key_value` (`key_settings`, `setting_key`, `setting_value`, `setting_group`, `entry_date_time`) VALUES
(1, 'site_name', 'Copilot CMS', 'general', '2025-10-06 23:07:08'),
(2, 'site_slogan', 'Clarity. Collaboration. Control.', 'general', '2025-10-06 23:07:08'),
(3, 'base_url', '/', 'general', '2025-10-06 23:18:10'),
(4, 'powered_by', 'Powered by Copilot', 'general', '2025-10-06 23:07:08'),
(11, 'article_show_author', '1', 'article_view', '2025-10-06 23:07:08'),
(12, 'article_show_categories', '1', 'article_view', '2025-10-06 23:07:08'),
(13, 'article_show_related_books', '1', 'article_view', '2025-10-06 23:07:08'),
(14, 'article_snippet_length', '300', 'article_view', '2025-10-06 23:07:08'),
(15, 'article_banner_height', '400px', 'article_view', '2025-10-06 23:07:08'),
(22, 'gallery_items_per_page', '12', 'gallery', '2025-10-06 23:07:08'),
(24, 'template_default_color', '#0055aa', 'css_colors', '2025-10-10 18:01:14'),
(27, 'default_404_message', 'Page not found.', 'php_template', '2025-10-06 23:07:08'),
(38, 'template_default_logo', '/templates/default/images/copilogcms.png', 'general', '2025-10-15 04:56:36'),
(40, 'max_upload_image_width', '2000', 'media_library', '2025-10-15 22:12:04'),
(41, 'max_upload_image_height', '1000', 'media_library', '2025-10-15 22:12:09'),
(42, 'template_text_color', 'black', 'css_colors', '2025-10-20 21:23:28'),
(43, 'template_background_color', '#FFF', 'css_colors', '2025-10-20 21:27:30'),
(45, 'items_brand_color', '#049b5c', 'css_colors', '2025-10-20 21:28:26'),
(46, 'sidebar_background_color', '#F6F6F6', 'css_colors', '2025-10-20 23:27:22'),
(47, 'site_direction', 'ltr', 'css_template', '2025-10-22 07:37:19'),
(48, 'google_fonts', 'Noto Kufi Arabic', 'css_fonts', '2025-10-27 21:33:32'),
(49, 'snippets_per_page', '10', 'php_template', '2025-10-30 09:49:38'),
(50, 'snippet_words', '80', 'php_template', '2025-10-30 11:14:33'),
(51, 'module_total_records', '7', 'php_template', '2025-11-06 19:49:34'),
(52, 'pager_next_label', 'Next', 'template_labels', '2025-11-06 19:52:48'),
(53, 'pager_prev_label', 'Prev', 'template_labels', '2025-11-06 19:53:02'),
(54, 'readmore_label', 'Read more', 'template_labels', '2025-11-06 19:54:21'),
(55, 'module_more_label', 'More', 'template_labels', '2025-11-07 16:38:31'),
(56, 'template_max_width', '1300px', 'css_template', '2025-11-07 17:21:27'),
(57, 'main_menu_font', 'Arial', 'css_fonts', '2025-11-07 18:40:16'),
(58, 'breadcrumb_font', 'Arial', 'css_fonts', '2025-11-07 18:54:58'),
(59, 'block_heading_font', 'Arial', 'css_fonts', '2025-11-07 20:10:46'),
(60, 'pager_font', 'Arial', 'css_fonts', '2025-11-07 20:15:54'),
(61, 'footer_font', 'Arial', 'css_fonts', '2025-11-07 21:16:04'),
(62, 'template_font_size', '15px', 'css_fonts', '2025-11-08 17:44:20'),
(64, 'content_banner_height', '20vh', 'css_template', '2025-11-14 22:02:08'),
(65, 'articles_label', 'Articles', 'template_labels', '2025-11-16 16:37:06'),
(66, 'content_types_label', 'Content Types', 'template_labels', '2025-11-16 16:37:26'),
(67, 'categories_label', 'Categories', 'template_labels', '2025-11-16 16:37:50'),
(68, 'tags_label', 'Tags', 'template_labels', '2025-11-16 16:37:58'),
(69, 'books_label', 'Books', 'template_labels', '2025-11-16 16:38:14'),
(70, 'pages_label', 'Info', 'template_labels', '2025-11-16 16:38:37'),
(71, 'authors_label', 'Authors', 'template_labels', '2025-11-16 16:38:49'),
(72, 'youtube_gallery_label', 'Youtube Gallery', 'template_labels', '2025-11-16 16:39:19'),
(73, 'photo_gallery_label', 'Photo Gallery', 'template_labels', '2025-11-16 16:39:35'),
(74, 'search_label', 'Search', 'template_labels', '2025-11-16 16:40:10'),
(75, 'cache_duration_hours', '2', 'cache', '2025-12-07 18:36:21'),
(76, 'cache_enabled', 'yes', 'cache', '2025-12-07 18:36:52'),
(77, 'css_version', '43', 'css_template', '2025-12-09 23:46:37'),
(78, 'article_authors_label', 'Article content', 'template_labels', '2025-12-13 12:54:06'),
(79, 'article_categories_label', 'Categories', 'template_labels', '2025-12-13 12:57:00'),
(80, 'article_content_types_label', 'Article Series', 'template_labels', '2025-12-13 12:57:20'),
(81, 'article_tags_label', 'Tags', 'template_labels', '2025-12-13 12:57:46'),
(82, 'show_article_created_updated', 'yes', 'php_template', '2025-12-20 18:41:46'),
(83, 'site_locale', 'en_US', 'php_template', '2025-12-20 19:06:46'),
(87, 'template_font_rtl', 'Noto Kufi Arabic', 'css_fonts', '2026-01-16 04:42:13'),
(88, 'template_font_ltr', 'calibri', 'css_fonts', '2026-01-16 04:42:37'),
(89, 'template_font_family', 'calibri', 'css_fonts', '2026-01-16 04:45:50'),
(90, 'template_font_rtl_line_height', '1.5', 'css_fonts', '2026-01-22 22:46:07'),
(91, 'template_font_ltr_line_height', '1.5', 'css_fonts', '2026-01-22 22:46:20'),
(92, 'template_font_rtl_size', '1em', 'css_fonts', '2026-01-22 22:46:39'),
(93, 'template_font_ltr_size', '1em', 'css_fonts', '2026-01-22 22:46:59'),
(95, 'article_workers_label', 'Banner image', 'template_labels', '2026-09-11 16:18:06'),
(96, 'articles_by_author_label', 'Author:', 'template_labels', '2026-09-18 05:52:26'),
(97, 'articles_by_worker_label', 'Worker:', 'template_labels', '2026-09-18 05:53:00'),
(98, 'search_results_per_page', '15', 'search', '2026-09-20 08:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `key_tags` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_tags`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`key_tags`, `key_media_banner`, `name`, `description`, `url`, `banner_image_url`, `sort`, `is_active`, `entry_date_time`) VALUES
(1, 0, 'Tag 1', '', 'tag-1', '', 0, 1, '2026-09-20 15:31:59'),
(2, 0, 'Tag 2', '', 'tag-2', '', 0, 1, '2026-09-20 15:32:03'),
(3, 0, 'Tag 3', '', 'tag-3', '', 0, 1, '2026-09-20 15:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `key_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('admin','editor','viewer') COLLATE utf8_unicode_ci DEFAULT 'viewer',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`key_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`key_user`, `key_media_banner`, `name`, `username`, `password_hash`, `email`, `role`, `is_active`, `entry_date_time`, `update_date_time`, `phone`, `address`, `city`, `state`, `country`, `description`, `url`, `banner_image_url`) VALUES
(1, 0, 'Copilot CMS', 'admin', '$2y$10$NHIqSMqCvTKHb3iDWIA4je/hMEfCWCENb9Pjmm/tckm6gvYAIM0ry', 'admin123@example.com', 'admin', 1, '2025-09-30 23:41:42', '2026-09-01 11:44:19', '', '123 Lions Garden, Old Town', '', '', 'Pakistan', '', 'admin-copilot', '');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
CREATE TABLE IF NOT EXISTS `workers` (
  `key_workers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `website` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media1` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media2` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media3` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `state` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '',
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_workers`) USING BTREE,
  KEY `fk_workers_media` (`key_media_banner`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `youtube_categories`
--

DROP TABLE IF EXISTS `youtube_categories`;
CREATE TABLE IF NOT EXISTS `youtube_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_youtube_gallery` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_youtube_gallery`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `youtube_gallery`
--

DROP TABLE IF EXISTS `youtube_gallery`;
CREATE TABLE IF NOT EXISTS `youtube_gallery` (
  `key_youtube_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`key_youtube_gallery`),
  KEY `fk_youtube_gallery_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles` ADD FULLTEXT KEY `title` (`title`,`title_sub`,`article_snippet`,`article_content`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors` ADD FULLTEXT KEY `name` (`name`,`description`,`city`,`country`,`state`);
ALTER TABLE `authors` ADD FULLTEXT KEY `name_2` (`name`,`city`,`country`,`description`);

--
-- Indexes for table `books`
--
ALTER TABLE `books` ADD FULLTEXT KEY `title` (`title`,`subtitle`,`publisher`,`description`,`author_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories` ADD FULLTEXT KEY `name` (`name`,`description`);

--
-- Indexes for table `media_library`
--
ALTER TABLE `media_library` ADD FULLTEXT KEY `alt_text` (`alt_text`,`tags`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages` ADD FULLTEXT KEY `title` (`title`,`page_content`);

--
-- Indexes for table `photo_gallery`
--
ALTER TABLE `photo_gallery` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Indexes for table `products`
--
ALTER TABLE `products` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Indexes for table `settings_key_value`
--
ALTER TABLE `settings_key_value` ADD FULLTEXT KEY `setting_key` (`setting_key`,`setting_value`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers` ADD FULLTEXT KEY `name` (`name`,`description`,`city`,`country`,`state`);
ALTER TABLE `workers` ADD FULLTEXT KEY `name_2` (`name`,`city`,`country`,`description`);

--
-- Indexes for table `youtube_gallery`
--
ALTER TABLE `youtube_gallery` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photo_gallery_images`
--
ALTER TABLE `photo_gallery_images`
  ADD CONSTRAINT `fk_gallery_image` FOREIGN KEY (`key_photo_gallery`) REFERENCES `photo_gallery` (`key_photo_gallery`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
