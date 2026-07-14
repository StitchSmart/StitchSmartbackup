# StitchSmart - AI-Assisted E-commerce Store

## Abstract

Over the past few years, online retailing has become increasingly popular. This growth has spurred the need for e-commerce websites to have superior systems that can handle products efficiently and provide their customers with personalized services. Yet, intelligent automation, smart product recommendations, advanced product customization, and intelligent customer support are still not offered in many traditional online stores. To tackle these problems, **StitchSmart**, an AI-Assisted E-commerce Store, has been developed using a dual technology stack featuring PHP (with a MySQL database) for the core web application and Python (FastAPI) for AI services.

StitchSmart allows customers to personalize apparel items such as hoodies, sweatpants, crewnecks, and shorts based on their preferences through an interactive **Design Studio**. A major highlight of the platform is its **RAG-based AI Chatbot**, powered by the **Google Gemini API**, which provides intelligent, context-aware assistance to customers in real-time. Additionally, the platform features an intelligent recommendation system that analyzes users' search history and browsing habits to suggest relevant and popular products. 

Other key features include Wishlist functionality, enabling customers to save products for later purchase; Product Comparison, allowing users to compare various items based on specifications, price, and features; and a streamlined Product Return process. The platform also offers secure online transactions with **JazzCash payment gateway integration** and keeps customers engaged via a **Newsletter subscription** feature.

In addition, StitchSmart empowers customers to rate and review products according to their buying experience, assisting other users in making informed decisions while providing valuable feedback to sellers. For administrators, low stock alerts are automatically triggered when inventory falls below a set threshold, ensuring timely restocking. Customers enjoy a seamless purchasing experience with the ability to order securely on the website, track orders effortlessly, and receive notifications via email and WhatsApp integration.

---

## Background

E-commerce is the marketing and sale of items and services online via digital platforms and applications. It has become an integral part of the modern business world, enabling customers to shop from anywhere and at any time without the need to visit a physical store. As online retail operations have grown, the number of products, services, and users has increased at an exponential rate, making it increasingly challenging for businesses to efficiently manage products, monitor stock levels, and maintain meaningful engagement with their customers.

Standard e-commerce platforms often lack in customization and require a significant amount of manual administration. Administrators need automated solutions to deal with stock management, product classification, content creation, and customer engagement. Key features such as product comparison, wishlists, ratings and reviews, product return management, and real-time notifications have also become essential expectations that directly impact user satisfaction and purchasing decisions.

Artificial Intelligence (AI) has brought a new dimension to the e-commerce landscape, marked by automation, personalization, and intelligent decision-making. These technologies assist users in discovering relevant products, obtaining immediate support, and enjoying a more tailored shopping experience. Within the apparel industry specifically, traditional online clothing stores often fall short by offering generic product listings without adapting to individual user preferences, and they lack the tools to let customers creatively design and customize their own apparel.

**StitchSmart** was developed to bridge this gap. It implements advanced AI techniques to optimize product discovery, automate customer support, and streamline system management — specifically targeting the online apparel market in Pakistan, where localized digital payments (JazzCash) and WhatsApp-based order notifications are highly relevant. By combining a robust PHP-based web platform with a Python-powered AI backend (FastAPI & Google Gemini API), StitchSmart aims to deliver a next-generation shopping experience that is smarter, more efficient, and consumer-friendly for both users and administrators.

---

## Problem Statement & Proposed Solution

**StitchSmart** is a smart, AI-Assisted E-Commerce platform designed to elevate the online shopping experience and optimize store management. Some of the main problems in current e-commerce systems are:

* **Lack of Personalization:** No tailored product suggestions or options to interactively customize apparel.
* **Poor Product Discovery:** Difficulty finding products and the absence of a Wishlist for future shopping.
* **No Product Comparison:** Customers cannot compare multiple products side by side based on specifications, price, and features before making a purchase decision.
* **No Intelligent Customer Support:** Absence of an AI-powered chatbot, forcing customers to wait for manual support responses.
* **Manual & Inefficient Management:** Time-consuming manual updates for products, banners, and categories without automated stock alerts.
* **Absence of AI Tools:** Lack of AI for auto-generating descriptions, hashtags, and handling customer support queries effectively.
* **Inadequate Post-Purchase Flow:** Missing streamlined returns, dynamic order tracking, and localized digital payments.

To overcome these challenges, **StitchSmart** offers a comprehensive solution featuring:
* **Advanced AI Integration:** Smart product recommendations, Live Search, AI-generated descriptions/hashtags, and a **RAG-powered AI Chatbot** (via Google Gemini API & FastAPI).
* **Interactive Design Studio:** Allowing customers to fully customize hoodies, crewnecks, shorts, and sweatpants.
* **Intelligent Store Management:** Automated email alerts for low-stock/restocks, dynamic CMS, and an Admin Analytics Dashboard.
* **Enhanced Shopping Experience:** Wishlist, Product Comparison, Ratings & Reviews, Discount Vouchers, secure **JazzCash Integration**, and a streamlined multi-stage return process.

These features ensure higher customer satisfaction, significantly reduced administrative burden, and enhanced overall efficiency for the e-commerce platform.

---

## 1.3 Objectives

The main objectives of the **StitchSmart** AI-Assisted E-Commerce Store are as follows:

1. **To design and build a full-featured e-commerce website** for apparel items — including hoodies, crewnecks, sweatpants, and shorts — allowing customers to make online purchases, browse products, and personalize items through an interactive Design Studio.

2. **To incorporate Artificial Intelligence** in delivering personalized product suggestions based on individual user interests, browsing history, and search behavior.

3. **To establish a product comparison mechanism** that enables customers to compare multiple apparel items side by side based on specifications, price, and features, facilitating informed purchase decisions.

4. **To implement a Ratings & Reviews feature** that empowers customers to share their feedback and rate products, helping other users make confident buying decisions.

5. **To integrate an AI-powered RAG-based Chatbot** — built using Python (FastAPI) and the Google Gemini API — to provide real-time customer support, guidance, and resolution of queries.

6. **To automate product content management** using AI-generated product descriptions and hashtags derived from uploaded product images, reducing manual administrative effort.

7. **To create automated low-stock alerts and smart inventory control**, ensuring administrators are notified in a timely manner to restock products before they run out.

8. **To integrate WhatsApp notifications and ordering** into the platform for enhanced customer communication, real-time order updates, and improved engagement.

9. **To minimize manual administrative tasks** through automation, AI-based management tools, and an Admin Analytics Dashboard for data-driven decision-making.

---

## 1.5 Business Goals

The following business goals are addressed by the **StitchSmart** AI-Assisted E-Commerce platform:

1. **Increase Online Sales Revenue:** By offering a seamless, user-friendly shopping experience with personalized AI-driven product recommendations and a secure JazzCash payment gateway, StitchSmart aims to drive higher conversion rates and increase overall online sales.

2. **Expand Customer Base & Market Reach:** Through WhatsApp-based ordering and notifications, newsletter subscriptions, and new product announcements via email, the platform targets a broader audience across Pakistan and increases brand visibility and reach.

3. **Improve Customer Retention & Loyalty:** Features such as Wishlist management, Discount Vouchers, a smooth product return process, and personalized shopping experiences are designed to build long-term customer loyalty and repeat purchases.

4. **Reduce Operational Costs Through Automation:** By automating inventory management, AI-generated product descriptions and hashtags, and low-stock email alerts, the platform significantly reduces the time and cost associated with manual store administration.

5. **Enhance Brand Identity Through Customization:** The interactive Design Studio allows customers to create personalized apparel, positioning StitchSmart as a premium, customer-centric brand that stands out in the competitive online fashion market.

6. **Enable Data-Driven Business Decisions:** The Admin Analytics Dashboard provides store administrators with actionable insights on sales trends, product performance, and customer behavior, enabling smarter, evidence-based business decisions.

7. **Build Customer Trust & Credibility:** The Ratings & Reviews system, transparent order tracking, and reliable post-purchase support (including returns management) help establish trust and a strong reputation for the brand.

8. **Deliver 24/7 Customer Engagement:** The AI-powered RAG-based Chatbot ensures that customer queries are handled around the clock without the need for dedicated human support staff, improving customer satisfaction while keeping operational costs low.

---

## 1.6 Document Conventions

This Software Requirements Specification (SRS) document for **StitchSmart** follows the standards and typographical conventions listed below to ensure clarity, consistency, and ease of reading throughout the document:

| Convention | Meaning / Usage |
|---|---|
| **Bold Text** | Used to highlight key terms, feature names, system components, or important concepts (e.g., **Design Studio**, **AI Chatbot**). |
| *Italic Text* | Used to denote technical terms, external system names, or terms being defined for the first time (e.g., *RAG*, *FastAPI*). |
| `Monospace / Code Font` | Used for file names, database names, code snippets, URLs, and configuration values (e.g., `StitchSmart`, `index.php`). |
| ALL CAPS | Used for requirement priority labels such as MUST, SHOULD, and MAY, following RFC 2119 conventions. |
| Numbered Lists | Used to present sequential steps, ordered objectives, or prioritized requirements. |
| Bulleted Lists | Used for non-ordered collections of features, constraints, or properties. |
| **[MUST]** | Indicates a mandatory functional or non-functional requirement that the system must fulfill. |
| **[SHOULD]** | Indicates a recommended requirement that is highly desirable but not strictly mandatory. |
| **[MAY]** | Indicates an optional requirement that may be implemented if time and resources allow. |
| Section Headings | Numbered headings (e.g., 1.1, 2.3) are used to organize content hierarchically as per the IEEE SRS standard. |
| External Systems | External systems and third-party integrations (e.g., *Google Gemini API*, *JazzCash*, *WhatsApp*) are written in italics on first mention. |

> **Note:** All requirements stated in this document are written from the perspective of the expected system behavior. The terms "system" and "platform" are used interchangeably to refer to the **StitchSmart** web application throughout this document.

