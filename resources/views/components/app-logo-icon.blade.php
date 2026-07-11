<svg xmlns="http://www.w3.org/2000/svg"
     viewBox="0 0 512 512"
     width="512" height="512"
     role="img" aria-labelledby="title desc">

  <title>House League</title>
  <desc>A house-shaped soccer crest with a soccer ball and field markings.</desc>

  <defs>
    <clipPath id="ball-clip">
      <circle cx="256" cy="220" r="79"/>
    </clipPath>
  </defs>

  <!-- Outer house and shield -->
  <path fill="#062A5F" d="
    M256 18
    L363 102
    V67
    Q363 55 375 55
    H410
    Q422 55 422 67
    V148
    L468 184
    Q480 194 472 207
    Q468 214 458 214
    H437
    V313
    C437 392 371 451 256 508
    C141 451 75 392 75 313
    V214
    H54
    Q44 214 40 207
    Q32 194 44 184
    Z"/>

  <!-- Inner white inset -->
  <path fill="#FFFFFF" d="
    M256 72
    L390 177
    V310
    C390 368 337 414 256 457
    C175 414 122 368 122 310
    V177
    Z"/>

  <!-- House interior -->
  <path fill="#062A5F" d="
    M256 94
    L370 184
    V299
    H142
    V184
    Z"/>

  <!-- Soccer field -->
  <path fill="#559C33" d="
    M142 318
    H370
    V320
    C370 359 331 399 256 439
    C181 399 142 359 142 320
    Z"/>

  <!-- Soccer ball -->
  <g clip-path="url(#ball-clip)">
    <circle cx="256" cy="220" r="79" fill="#FFFFFF"/>
    <line x1="256.00" y1="190.00" x2="256.00" y2="154.00" stroke="#062A5F" stroke-width="9" stroke-linecap="round"/><line x1="284.53" y1="210.73" x2="318.77" y2="199.60" stroke="#062A5F" stroke-width="9" stroke-linecap="round"/><line x1="273.63" y1="244.27" x2="294.79" y2="273.40" stroke="#062A5F" stroke-width="9" stroke-linecap="round"/><line x1="238.37" y1="244.27" x2="217.21" y2="273.40" stroke="#062A5F" stroke-width="9" stroke-linecap="round"/><line x1="227.47" y1="210.73" x2="193.23" y2="199.60" stroke="#062A5F" stroke-width="9" stroke-linecap="round"/>
    <polygon points="256.00,190.00 284.53,210.73 273.63,244.27 238.37,244.27 227.47,210.73" fill="#062A5F"/>
    <polygon points="268.93,136.20 276.92,160.80 256.00,176.00 235.08,160.80 243.07,136.20" fill="#062A5F"/><polygon points="339.69,206.40 318.77,221.60 297.85,206.40 305.84,181.81 331.70,181.81" fill="#062A5F"/><polygon points="294.79,295.40 273.87,280.19 281.86,255.60 307.73,255.60 315.72,280.19" fill="#062A5F"/><polygon points="196.28,280.19 204.27,255.60 230.14,255.60 238.13,280.19 217.21,295.40" fill="#062A5F"/><polygon points="180.30,181.81 206.16,181.81 214.15,206.40 193.23,221.60 172.31,206.40" fill="#062A5F"/>
  </g>
  <circle cx="256" cy="220" r="79" fill="none" stroke="#062A5F" stroke-width="8"/>

  <!-- Field markings -->
  <line x1="256" y1="318" x2="256" y2="438"
        stroke="#FFFFFF" stroke-width="10"/>
  <circle cx="256" cy="361" r="45"
          fill="none" stroke="#FFFFFF" stroke-width="10"/>
  <circle cx="256" cy="361" r="8" fill="#FFFFFF"/>

</svg>
