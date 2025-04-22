<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asian - Healthy & Delicious Sea Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2A7D5F',
                        secondary: '#F26B3A',
                        yellow: '#F9D949',
                        lightGreen: '#3D9970',
                        coral: '#FF8C69',
                        background: '#2A7D5F'
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .category-circle {
            border-radius: 50%;
            overflow: hidden;
            position: relative;
        }
        .category-slider {
            position: relative;
        }
        .category-slider::before,
        .category-slider::after {
            content: '';
            position: absolute;
            height: 80px;
            width: 80px;
            border: 2px solid #F26B3A;
            border-radius: 50%;
            z-index: -1;
        }
        .category-slider::before {
            top: -10px;
            left: -10px;
            border-top-color: transparent;
            border-right-color: transparent;
        }
        .category-slider::after {
            bottom: -10px;
            right: -10px;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
    </style>
</head>
<body class="bg-background">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto">
        <!-- Hero Section -->
        <div class="bg-white rounded-3xl p-8 my-8 mx-4 lg:mx-auto">
            <!-- Navigation -->
            <nav class="flex justify-between items-center mb-12">
                <div class="font-bold text-2xl">Caffe Pemersatu Bangsa</div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-700">Categories</a>
                    <a href="#" class="text-gray-700">Feature</a>
                    <a href="#" class="text-gray-700">Review</a>
                </div>
                <button class="bg-yellow-100 text-secondary font-medium px-4 py-2 rounded-full flex items-center">
                    <a href="/login" class="text-gray-700">Join us</a>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </nav>

            <!-- Hero Content -->
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <div class="relative">
                        {{-- <img src="/placeholder.svg?height=80&width=150" alt="Decorative element" class="absolute -top-16 -left-8 w-32 opacity-80" /> --}}
                        <h1 class="text-5xl font-bold leading-tight">
                            Healthy & 
                            <span class="relative inline-block">
                                Delicious
                                <span class="absolute top-0 right-0 bg-primary text-white px-4 py-1 rounded-full text-sm"></span>
                            </span>
                            <br />
                            <span class="text-primary">Sea Food</span>
                        </h1>
                    </div>
                    
                    <div class="flex items-center mt-6 mb-8">
                        <div class="bg-orange-100 rounded-full p-2 mr-4">
                            <button class="bg-secondary text-white rounded-full w-10 h-10 flex items-center justify-center">
                                <svg xmlns="hero.jpg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <div class="relative">
                            <img src="/placeholder.svg?height=150&width=250" alt="Salmon sushi" class="rounded-xl w-48" />
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-8">
                        At Sushi Kantorei we offer meals of excellent quality and invite you to try our delicious food.
                    </p>
                    
                    <div class="bottom-10 right-10">
                        <div class="bg-secondary text-white rounded-full p-4 flex items-center justify-center">
                            Order Now
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2 relative">
                    <div class="bg-yellow-100 rounded-3xl p-8 relative">
                        <div class="relative mx-auto w-48 mb-6">
                            <img src="/hero.jpg" alt="Mobile app screenshot" class="mx-auto" />
                        </div>
                        
                        <div class="flex justify-between items-center">
                           
                            
                            <div class="flex space-x-4">
                                <div class="bg-white p-2 rounded-xl">
                                    <div class="text-yellow-500 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="font-bold">4.8/5</span>
                                    </div>
                                </div>
                                <div class="bg-white p-2 rounded-xl">
                                    <div class="text-yellow-500 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="font-bold">4.9/5</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="bg-white rounded-3xl p-8 my-8 mx-4 lg:mx-auto">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl font-bold">Our Best Delivered</h2>
                    <h2 class="text-3xl font-bold text-primary">Categories</h2>
                </div>
                <div class="flex space-x-4">
                    <button class="bg-gray-100 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="bg-secondary text-white rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="category-circle bg-lightGreen p-4 w-64 h-64 flex items-center justify-center">
                    <img src="/hero.jpg" alt="Sushi rolls" class="w-full h-full object-cover" />
                </div>
                
                <div class="category-circle bg-yellow p-4 w-72 h-72 flex items-center justify-center category-slider">
                    <img src="/hero.jpg" alt="Sushi platter" class="w-full h-full object-cover" />
                </div>
                
                <div class="category-circle bg-coral p-4 w-64 h-64 flex items-center justify-center">
                    <img src="/hero.jpg" alt="Sushi variety" class="w-full h-full object-cover" />
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="bg-white rounded-3xl p-8 my-8 mx-4 lg:mx-auto">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <h2 class="text-3xl font-bold mb-8">Why Choose <span class="text-primary">Us</span></h2>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium">Menu browsing</h4>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium">Personalization</h4>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium">Ordering</h4>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium">Multiple language support</h4>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium">Payment</h4>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium">Rewards</h4>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium">Tracking</h4>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium">Quick & light them</h4>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2 flex justify-center">
                    <div class="relative w-64">
                        <img src="/placeholder.svg?height=500&width=250" alt="Mobile app categories" class="mx-auto" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-yellow-100 rounded-3xl p-8 my-8 mx-4 lg:mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <h3 class="text-2xl font-bold">800k</h3>
                    <p class="text-sm text-gray-600">Order was delivered</p>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">4.9</h3>
                    <p class="text-sm text-gray-600">Google reviews</p>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">65+</h3>
                    <p class="text-sm text-gray-600">Providers from different restaurants</p>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">120k</h3>
                    <p class="text-sm text-gray-600">Number of reviews</p>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="bg-white rounded-3xl p-8 my-8 mx-4 lg:mx-auto">
            <h2 class="text-3xl font-bold mb-12">Customers <span class="text-gray-800">Say</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-xl relative">
                    <div class="text-yellow-500 text-4xl absolute -top-4 -left-2">"</div>
                    <p class="text-gray-700 mb-4">
                        "I love to there! It's great for both lunch and dinner. The food is high quality, super expensive sushi that's great. If you get the all-you-can-eat choice."
                    </p>
                    <div class="flex items-center">
                        <img src="/placeholder.svg?height=40&width=40" alt="Customer" class="w-10 h-10 rounded-full mr-3" />
                        <div>
                            <h5 class="font-medium">Jenny Wilson</h5>
                            <div class="flex text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-