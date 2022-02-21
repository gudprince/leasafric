<x-front-layout>
    <x-slot name="title">
        Guide
    </x-slot>
    <div class="mb-4 text-center bg-secondary text-white">
       <h2 class="py-4">Leasafric  Test API Documentation</h2>
    </div>
    <div class="container">
      <h4  class="mb-4 mt-4">Getting a resources</h4>
        <!-- HTML generated using hilite.me --><div class="mb-4" style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">fetch(</span><span style="color: #0086d2">&#39;{{env('APP_URL')}}/api/posts/1&#39;</span><span style="color: #ffffff">)</span>
  <span style="color: #ffffff">.then((response)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">response.json())</span>
  <span style="color: #ffffff">.then((json)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">console.log(json));</span>
</pre></div>

        <h4 class="mb-4">👇 Output</h4>
        <!-- HTML generated using hilite.me --><div style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">{</span>
  <span style="color: #ffffff">id:</span> <span style="color: #0086f7; font-weight: bold">1</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;...&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">body:</span> <span style="color: #0086d2">&#39;...&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">userId:</span> <span style="color: #0086f7; font-weight: bold">1</span>
<span style="color: #ffffff">}</span>
</pre></div>



        <h4  class="mb-4 mt-4">Listing all resources</h4>
        <!-- HTML generated using hilite.me --><div style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">fetch(</span><span style="color: #0086d2">&#39;{{env('APP_URL')}}/api/posts&#39;</span><span style="color: #ffffff">)</span>
  <span style="color: #ffffff">.then((response)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">response.json())</span>
  <span style="color: #ffffff">.then((json)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">console.log(json));</span>
</pre></div>

        <h4 class="mb-4 mt-4">👇 Output</h4>
        <!-- HTML generated using hilite.me --><div class="mb-4" style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">[</span>
  <span style="color: #ffffff">{</span> <span style="color: #ffffff">id:</span> <span style="color: #0086f7; font-weight: bold">1</span><span style="color: #ffffff">,</span> <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;...&#39;</span> <span style="color: #008800; font-style: italic; background-color: #0f140f">/* ... */</span> <span style="color: #ffffff">},</span>
  <span style="color: #ffffff">{</span> <span style="color: #ffffff">id:</span> <span style="color: #0086f7; font-weight: bold">2</span><span style="color: #ffffff">,</span> <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;...&#39;</span> <span style="color: #008800; font-style: italic; background-color: #0f140f">/* ... */</span> <span style="color: #ffffff">},</span>
  <span style="color: #ffffff">{</span> <span style="color: #ffffff">id:</span> <span style="color: #0086f7; font-weight: bold">3</span><span style="color: #ffffff">,</span> <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;...&#39;</span> <span style="color: #008800; font-style: italic; background-color: #0f140f">/* ... */</span> <span style="color: #ffffff">},</span>
  <span style="color: #008800; font-style: italic; background-color: #0f140f">/* ... */</span>
  <span style="color: #ffffff">{</span> <span style="color: #ffffff">id:</span> <span style="color: #0086f7; font-weight: bold">100</span><span style="color: #ffffff">,</span> <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;...&#39;</span> <span style="color: #008800; font-style: italic; background-color: #0f140f">/* ... */</span> <span style="color: #ffffff">},</span>
<span style="color: #ffffff">];</span>
</pre></div>


        <h4 class="mb-4 mt-6" >Creating a resource</h4>
        <!-- HTML generated using hilite.me --><div class="mb-4" style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">fetch(</span><span style="color: #0086d2">&#39;{{env('APP_URL')}}/api/posts&#39;</span><span style="color: #ffffff">,</span> <span style="color: #ffffff">{</span>
  <span style="color: #ffffff">method:</span> <span style="color: #0086d2">&#39;POST&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">body:</span> <span style="color: #ffffff">JSON.stringify({</span>
    <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;foo&#39;</span><span style="color: #ffffff">,</span>
    <span style="color: #ffffff">body:</span> <span style="color: #0086d2">&#39;bar&#39;</span><span style="color: #ffffff">,</span>
    <span style="color: #ffffff">userId:</span> <span style="color: #0086f7; font-weight: bold">1</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">}),</span>
  <span style="color: #ffffff">headers:</span> <span style="color: #ffffff">{</span>
    <span style="color: #0086d2">&#39;Content-type&#39;</span><span style="color: #ffffff">:</span> <span style="color: #0086d2">&#39;application/json; charset=UTF-8&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">},</span>
<span style="color: #ffffff">})</span>
  <span style="color: #ffffff">.then((response)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">response.json())</span>
  <span style="color: #ffffff">.then((json)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">console.log(json));</span>
</pre></div>

        
        <h4 class="mb-4 mt-2">👇 Output</h4>

        <!-- HTML generated using hilite.me --><div class="mb-4" style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">{</span>
  <span style="color: #ffffff">id:</span> <span style="color: #0086f7; font-weight: bold">101</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;foo&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">body:</span> <span style="color: #0086d2">&#39;bar&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">userId:</span> <span style="color: #0086f7; font-weight: bold">1</span>
<span style="color: #ffffff">}</span>
</pre></div>

        <div class="mb-4"><strong>Important: </strong>resource will not be really created on the server but it will be faked as if.</div>
        
        <h4 class="mb-4 mt-6" >Updating a resource</h4>
        
        <!-- HTML generated using hilite.me --><div style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">fetch(</span><span style="color: #0086d2">&#39;{{env('APP_URL')}}/api/posts/1&#39;</span><span style="color: #ffffff">,</span> <span style="color: #ffffff">{</span>
  <span style="color: #ffffff">method:</span> <span style="color: #0086d2">&#39;PUT&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">body:</span> <span style="color: #ffffff">JSON.stringify({</span>
    <span style="color: #ffffff">id:</span> <span style="color: #0086f7; font-weight: bold">1</span><span style="color: #ffffff">,</span>
    <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;foo&#39;</span><span style="color: #ffffff">,</span>
    <span style="color: #ffffff">body:</span> <span style="color: #0086d2">&#39;bar&#39;</span><span style="color: #ffffff">,</span>
    <span style="color: #ffffff">userId:</span> <span style="color: #0086f7; font-weight: bold">1</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">}),</span>
  <span style="color: #ffffff">headers:</span> <span style="color: #ffffff">{</span>
    <span style="color: #0086d2">&#39;Content-type&#39;</span><span style="color: #ffffff">:</span> <span style="color: #0086d2">&#39;application/json; charset=UTF-8&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">},</span>
<span style="color: #ffffff">})</span>
  <span style="color: #ffffff">.then((response)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">response.json())</span>
  <span style="color: #ffffff">.then((json)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">console.log(json));</span>
</pre></div>


            
        <h4 class="mb-4 mt-4">👇 Output</h4>
        <!-- HTML generated using hilite.me --><div style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">{</span>
  <span style="color: #ffffff">id:</span> <span style="color: #0086f7; font-weight: bold">1</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;foo&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">body:</span> <span style="color: #0086d2">&#39;bar&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">userId:</span> <span style="color: #0086f7; font-weight: bold">1</span>
<span style="color: #ffffff">}</span>
</pre></div>


        <div class="mb-4 mt-4"><strong>Important: </strong>resource will not be really updated on the server but it will be faked as if.</div>
        
            
        <h4 class="mb-4 mt-6" >Patching a resource</h4>

        <!-- HTML generated using hilite.me --><div style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">fetch(</span><span style="color: #0086d2">&#39;{{env('APP_URL')}}/api/posts/1&#39;</span><span style="color: #ffffff">,</span> <span style="color: #ffffff">{</span>
  <span style="color: #ffffff">method:</span> <span style="color: #0086d2">&#39;PATCH&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">body:</span> <span style="color: #ffffff">JSON.stringify({</span>
    <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;foo&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">}),</span>
  <span style="color: #ffffff">headers:</span> <span style="color: #ffffff">{</span>
    <span style="color: #0086d2">&#39;Content-type&#39;</span><span style="color: #ffffff">:</span> <span style="color: #0086d2">&#39;application/json; charset=UTF-8&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">},</span>
<span style="color: #ffffff">})</span>
  <span style="color: #ffffff">.then((response)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">response.json())</span>
  <span style="color: #ffffff">.then((json)</span> <span style="color: #ffffff">=&gt;</span> <span style="color: #ffffff">console.log(json));</span>
</pre></div>

        

        <h4 class="mb-4 mt-4">👇 Output</h4>
        <!-- HTML generated using hilite.me --><div style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">{</span>
  <span style="color: #ffffff">id:</span> <span style="color: #0086f7; font-weight: bold">1</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">title:</span> <span style="color: #0086d2">&#39;foo&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">body:</span> <span style="color: #0086d2">&#39;...&#39;</span><span style="color: #ffffff">,</span>
  <span style="color: #ffffff">userId:</span> <span style="color: #0086f7; font-weight: bold">1</span>
<span style="color: #ffffff">}</span>
</pre></div>

        <div class="mb-4 mt-4"><strong>Important: </strong>resource will not be really updated on the server but it will be faked as if.</div>
        
        <h4 class="mb-4 mt-6" >Deleting a resource</h4>

        <!-- HTML generated using hilite.me --><div style="background: #111111; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.8em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #ffffff">fetch(</span><span style="color: #0086d2">&#39;{{env('APP_URL')}}/api/posts/1&#39;</span><span style="color: #ffffff">,</span> <span style="color: #ffffff">{</span>
  <span style="color: #ffffff">method:</span> <span style="color: #0086d2">&#39;DELETE&#39;</span><span style="color: #ffffff">,</span>
<span style="color: #ffffff">});</span>
</pre></div>

        <div class="mb-4 mt-4"><strong>Important: </strong>resource will not be really Deleted on the server but it will be faked as if.</div>
        
        <h4 class="mb-4 mt-6" >The available nested routes are:</h4>
        <div class="mb-4">
            <a href="{{url('api/posts/1/comments')}}">/posts/1/comments</a><br>
            <a href="{{url('api/albums/1/photos')}}">/albums/1/photos</a><br>
            <a href="{{url('api/users/1/albums')}}">/users/1/albums</a><br>
            <a href="{{url('api/users/1/todos')}}">/users/1/todos</a><br>
            <a href="{{url('api/users/1/posts')}}">/users/1/posts</a>
        </div>
    </div>

</x-front-layout>