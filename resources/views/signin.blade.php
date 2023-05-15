<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login/Assignment</title>
    <script src="{{ asset('css/tailwindcss.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg-gray-100">
    <div class="">
        <div>
            <nav class="shadow-xl p-3 my-3">
                <ul class="flex text-slate-900 font-semibold justify-between cursor-pointer mx-2">
                    <li class="font-bold text-xl capitalize">LARAVEL <span class="text-orange-600">ASSIGNMENT</span>
                    </li>
                    <div class="flex gap-3">
                        <li class="bg-slate-600 text-white rounded p-1 hover:text-orange-600">
                            Sign in
                        </li>
                        <li class="bg-slate-600 text-white rounded p-1
                         hover:text-orange-600">
                         Sign up
                        </li>
                    </div>
                </ul>
            </nav>
            <div class="grid grid-cols-12">

                <div class="shadow-xl col-span-3 flex justify-center">
                    <form action="/" method="post">
                        <div>
                            <h1 class="font-semibold text-orange-600 my-3 text-xl">Login here!!!</h1><hr><br>
                            
                            <label for="username" class="mx-3 font-semibold my-4">Username</label><br>
                            <input type="text" name="username" id="" class="p-2 w-full rounded bg-slate-300 ">

                            <label for="password" class="font-semibold my-4">Password</label><br>
                            <input type="password" name="password" id="" class="p-2 w-full rounded bg-slate-300"> <br>

                            <label for="check" class="cursor-pointer font-semibold">Remember me</label>
                            <input type="checkbox" name="remember" id="check"><br>

                            <input type="submit" value="Login" class="p-2 w-full rounded bg-orange-600 my-3 text-white font-semibold hover:bg-orange-700 cursor-pointer"> <br>

                            <p class="text-end my-3 text-orange-600 font-semibold underline">
                            <a href="http://" >I forgot my password?</a>
                            </p>

                        </div>
                    </form>
                </div>

                <div class="mx-4 col-span-9">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit maxime facere aspernatur suscipit
                    nisi temporibus voluptates iure maiores nemo iste at sunt reiciendis, molestias distinctio,
                    repudiandae adipisci quam magnam minima.
                    From the tiniest subatomic particles to the largest galaxies, everything in the universe is governed
                    by a set of natural laws that we are still striving to understand. Scientists have spent centuries
                    studying the mysteries of the cosmos, yet we have only scratched the surface of what lies beyond our
                    planet.

                    As humans, we are but a mere blip in the grand scheme of things, a fleeting moment in the vastness
                    of time and space. Yet, we are also the guardians of our planet, entrusted with the task of
                    protecting it and preserving it for future generations.

                    Through our curiosity and ingenuity, we have made incredible strides in science, technology, and
                    medicine, improving our lives in countless ways. But we still have much to learn, and the mysteries
                    of the universe continue to beckon us onward.

                    So let us venture forth into the great unknown, with open minds and fearless hearts, and explore the
                    wonders that lie beyond our reach. For it is only through exploration and discovery that we can hope
                    to unlock the secrets of the cosmos

                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem eveniet et sunt iure molestias, aut ex obcaecati soluta explicabo repellat repudiandae architecto ratione blanditiis quia fugit? Eius qui illum necessitatibus!
                </div>
            </div>
        </div>
    </div>
</body>

</html>