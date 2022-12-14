if(sessionStorage.getItem("userMail")!=null)
{
    window.location = "home.php";
}
var design = anime({
    targets: 'svg #XMLID5',
    keyframes: [{translateX: -500}, {rotateY: 180}, {translateX: 920}, {rotateY: 0}, {translateX: -500}, {rotateY: 180}, {translateX: -500},],
    easing: 'easeInOutSine',
    duration: 60000,
  });
anime({
    targets: '#dust-particle path',
    translateY: [10, -150],
    direction: 'alternate',
    loop: true,
    delay: function(el, i, l) {return i * 100;},
    endDelay: function(el, i, l) {return (l - i) * 100;}
  });
var userID = document.querySelector('#userMail');
var password = document.querySelector('#password');
var mySVG = document.querySelector('.svgContainer');
var armL = document.querySelector('.armL');
var armR = document.querySelector('.armR');
var eyeL = document.querySelector('.eyeL');
var eyeR = document.querySelector('.eyeR');
var nose = document.querySelector('.nose');
var mouth = document.querySelector('.mouth');
var mouthBG = document.querySelector('.mouthBG');
var mouthSmallBG = document.querySelector('.mouthSmallBG');
var mouthMediumBG = document.querySelector('.mouthMediumBG');
var mouthLargeBG = document.querySelector('.mouthLargeBG');
var mouthMaskPath = document.querySelector('#mouthMaskPath');
var mouthOutline = document.querySelector('.mouthOutline');
var tooth = document.querySelector('.tooth');
var tongue = document.querySelector('.tongue');
var chin = document.querySelector('.chin');
var face = document.querySelector('.face');
var eyebrow = document.querySelector('.eyebrow');
var outerEarL = document.querySelector('.earL .outerEar');
var outerEarR = document.querySelector('.earR .outerEar');
var earHairL = document.querySelector('.earL .earHair');
var earHairR = document.querySelector('.earR .earHair');
var hair = document.querySelector('.hair');
var caretPos, curIDIndex, screenCenter, svgCoords, eyeMaxHorizD = 20, eyeMaxVertD = 10, noseMaxHorizD = 23, noseMaxVertD = 10, dFromC, eyeDistH, eyeLDistV, eyeRDistV, eyeDistR, mouthStatus = "small";
function getCoord(e)
{
	var carPos = userID.selectionEnd;
    var div = document.createElement('div');
    var span = document.createElement('span');
	var copyStyle = getComputedStyle(userID);
	var IDCoords = {}, caretCoords = {}, centerCoords = {};
	[].forEach.call(copyStyle, function(prop){
		div.style[prop] = copyStyle[prop];
	});
	div.style.position = 'absolute';
	document.body.appendChild(div);
	div.textContent = userID.value.substr(0, carPos);
	span.textContent = userID.value.substr(carPos) || '.';
	div.appendChild(span);
	IDCoords = getPosition(userID);
	caretCoords = getPosition(span);
	centerCoords = getPosition(mySVG);
	svgCoords = getPosition(mySVG);
	screenCenter = centerCoords.x + (mySVG.offsetWidth / 2);
	caretPos = caretCoords.x + IDCoords.x;
	dFromC = screenCenter - caretPos;
	var pFromC = Math.round((caretPos / screenCenter) * 100) / 100;
	if(pFromC < 1)
    {
    }
    else if(pFromC > 1)
    {
		pFromC -= 2;
		pFromC = Math.abs(pFromC);
	}
	eyeDistH = -dFromC * .05;
	if(eyeDistH > eyeMaxHorizD)
    {
        eyeDistH = eyeMaxHorizD;
	}
    else if(eyeDistH < -eyeMaxHorizD)
    {
        eyeDistH = -eyeMaxHorizD;
	}
	var eyeLCoords = {x: svgCoords.x + 84, y: svgCoords.y + 76};
	var eyeRCoords = {x: svgCoords.x + 113, y: svgCoords.y + 76};
	var noseCoords = {x: svgCoords.x + 97, y: svgCoords.y + 81};
	var mouthCoords = {x: svgCoords.x + 100, y: svgCoords.y + 100};
	var eyeLAngle = getAngle(eyeLCoords.x, eyeLCoords.y, IDCoords.x + caretCoords.x, IDCoords.y + 25);
	var eyeLX = Math.cos(eyeLAngle) * eyeMaxHorizD;
	var eyeLY = Math.sin(eyeLAngle) * eyeMaxVertD;
	var eyeRAngle = getAngle(eyeRCoords.x, eyeRCoords.y, IDCoords.x + caretCoords.x, IDCoords.y + 25);
	var eyeRX = Math.cos(eyeRAngle) * eyeMaxHorizD;
	var eyeRY = Math.sin(eyeRAngle) * eyeMaxVertD;
	var noseAngle = getAngle(noseCoords.x, noseCoords.y, IDCoords.x + caretCoords.x, IDCoords.y + 25);
	var noseX = Math.cos(noseAngle) * noseMaxHorizD;
	var noseY = Math.sin(noseAngle) * noseMaxVertD;
	var mouthAngle = getAngle(mouthCoords.x, mouthCoords.y, IDCoords.x + caretCoords.x, IDCoords.y + 25);
	var mouthX = Math.cos(mouthAngle) * noseMaxHorizD;
	var mouthY = Math.sin(mouthAngle) * noseMaxVertD;
	var mouthR = Math.cos(mouthAngle) * 6;
	var chinX = mouthX * .8;
	var chinY = mouthY * .5;
	var chinS = 1 - ((dFromC * .15) / 100);
	if(chinS > 1)
    {
        chinS = 1 - (chinS - 1);
    }
	var faceX = mouthX * .3;
	var faceY = mouthY * .4;
	var faceSkew = Math.cos(mouthAngle) * 5;
	var eyebrowSkew = Math.cos(mouthAngle) * 25;
	var outerEarX = Math.cos(mouthAngle) * 4;
	var outerEarY = Math.cos(mouthAngle) * 5;
	var hairX = Math.cos(mouthAngle) * 6;
	var hairS = 1.2;
	TweenMax.to(eyeL, 1, {x: -eyeLX , y: -eyeLY, ease: Expo.easeOut});
	TweenMax.to(eyeR, 1, {x: -eyeRX , y: -eyeRY, ease: Expo.easeOut});
	TweenMax.to(nose, 1, {x: -noseX, y: -noseY, rotation: mouthR, transformOrigin: "center center", ease: Expo.easeOut});
	TweenMax.to(mouth, 1, {x: -mouthX , y: -mouthY, rotation: mouthR, transformOrigin: "center center", ease: Expo.easeOut});
	TweenMax.to(chin, 1, {x: -chinX, y: -chinY, scaleY: chinS, ease: Expo.easeOut});
	TweenMax.to(face, 1, {x: -faceX, y: -faceY, skewX: -faceSkew, transformOrigin: "center top", ease: Expo.easeOut});
	TweenMax.to(eyebrow, 1, {x: -faceX, y: -faceY, skewX: -eyebrowSkew, transformOrigin: "center top", ease: Expo.easeOut});
	TweenMax.to(outerEarL, 1, {x: outerEarX, y: -outerEarY, ease: Expo.easeOut});
	TweenMax.to(outerEarR, 1, {x: outerEarX, y: outerEarY, ease: Expo.easeOut});
	TweenMax.to(earHairL, 1, {x: -outerEarX, y: -outerEarY, ease: Expo.easeOut});
	TweenMax.to(earHairR, 1, {x: -outerEarX, y: outerEarY, ease: Expo.easeOut});
	TweenMax.to(hair, 1, {x: hairX, scaleY: hairS, transformOrigin: "center bottom", ease: Expo.easeOut});
	document.body.removeChild(div);
};
function onIDInput(e)
{
	getCoord(e);
	var value = e.target.value;
	curIDIndex = value.length;
	if(curIDIndex > 0)
    {
		if(mouthStatus == "small")
        {
			mouthStatus = "medium";
			TweenMax.to([mouthBG, mouthOutline, mouthMaskPath], 1, {morphSVG: mouthMediumBG, shapeIndex: 8, ease: Expo.easeOut});
			TweenMax.to(tooth, 1, {x: 0, y: 0, ease: Expo.easeOut});
			TweenMax.to(tongue, 1, {x: 0, y: 1, ease: Expo.easeOut});
			TweenMax.to([eyeL, eyeR], 1, {scaleX: .85, scaleY: .85, ease: Expo.easeOut});
		}
		if(value.includes("@"))
        {
			mouthStatus = "large";
			TweenMax.to([mouthBG, mouthOutline, mouthMaskPath], 1, {morphSVG: mouthLargeBG, ease: Expo.easeOut});
			TweenMax.to(tooth, 1, {x: 3, y: -2, ease: Expo.easeOut});
			TweenMax.to(tongue, 1, {y: 2, ease: Expo.easeOut});
			TweenMax.to([eyeL, eyeR], 1, {scaleX: .65, scaleY: .65, ease: Expo.easeOut, transformOrigin: "center center"});
		}
        else
        {
			mouthStatus = "medium";
			TweenMax.to([mouthBG, mouthOutline, mouthMaskPath], 1, {morphSVG: mouthMediumBG, ease: Expo.easeOut});
			TweenMax.to(tooth, 1, {x: 0, y: 0, ease: Expo.easeOut});
			TweenMax.to(tongue, 1, {x: 0, y: 1, ease: Expo.easeOut});
			TweenMax.to([eyeL, eyeR], 1, {scaleX: .85, scaleY: .85, ease: Expo.easeOut});
		}
	}
    else
    {
		mouthStatus = "small";
		TweenMax.to([mouthBG, mouthOutline, mouthMaskPath], 1, {morphSVG: mouthSmallBG, shapeIndex: 9, ease: Expo.easeOut});
		TweenMax.to(tooth, 1, {x: 0, y: 0, ease: Expo.easeOut});
		TweenMax.to(tongue, 1, {y: 0, ease: Expo.easeOut});
		TweenMax.to([eyeL, eyeR], 1, {scaleX: 1, scaleY: 1, ease: Expo.easeOut});
	}
}
function onIDFocus(e)
{
	e.target.parentElement.classList.add("focusWithText");
	getCoord();
}
function onIDBlur(e)
{
	if(e.target.value == "")
    {
		e.target.parentElement.classList.remove("focusWithText");
	}
	resetFace();
}
function onPasswordFocus(e)
{
	coverEyes();
}
function onPasswordBlur(e)
{
	uncoverEyes();
}
function coverEyes()
{
	TweenMax.to(armL, .45, {x: -93, y: 2, rotation: 0, ease: Quad.easeOut});
	TweenMax.to(armR, .45, {x: -93, y: 2, rotation: 0, ease: Quad.easeOut, delay: .1});
}
function uncoverEyes()
{
	TweenMax.to(armL, 1.35, {y: 220, ease: Quad.easeOut});
	TweenMax.to(armL, 1.35, {rotation: 105, ease: Quad.easeOut, delay: .1});
	TweenMax.to(armR, 1.35, {y: 220, ease: Quad.easeOut});
	TweenMax.to(armR, 1.35, {rotation: -105, ease: Quad.easeOut, delay: .1});
}
function resetFace()
{
	TweenMax.to([eyeL, eyeR], 1, {x: 0, y: 0, ease: Expo.easeOut});
	TweenMax.to(nose, 1, {x: 0, y: 0, scaleX: 1, scaleY: 1, ease: Expo.easeOut});
	TweenMax.to(mouth, 1, {x: 0, y: 0, rotation: 0, ease: Expo.easeOut});
	TweenMax.to(chin, 1, {x: 0, y: 0, scaleY: 1, ease: Expo.easeOut});
	TweenMax.to([face, eyebrow], 1, {x: 0, y: 0, skewX: 0, ease: Expo.easeOut});
	TweenMax.to([outerEarL, outerEarR, earHairL, earHairR, hair], 1, {x: 0, y: 0, scaleY: 1, ease: Expo.easeOut});
}
function getAngle(x1, y1, x2, y2)
{
	var angle = Math.atan2(y1 - y2, x1 - x2);
	return angle;
}
function getPosition(el)
{
	var xPos = 0;
	var yPos = 0;
	while (el)
    {
		if (el.tagName == "BODY")
        {
			var xScroll = el.scrollLeft || document.documentElement.scrollLeft;
			var yScroll = el.scrollTop || document.documentElement.scrollTop;
			xPos += (el.offsetLeft - xScroll + el.clientLeft);
			yPos += (el.offsetTop - yScroll + el.clientTop);
		}
        else
        {
			xPos += (el.offsetLeft - el.scrollLeft + el.clientLeft);
			yPos += (el.offsetTop - el.scrollTop + el.clientTop);
		}
		el = el.offsetParent;
	}
	return {x: xPos,y: yPos};
}
userID.addEventListener('focus', onIDFocus);
userID.addEventListener('blur', onIDBlur);
userID.addEventListener('input', onIDInput);
password.addEventListener('focus', onPasswordFocus);
password.addEventListener('blur', onPasswordBlur);
TweenMax.set(armL, {x: -93, y: 220, rotation: 105, transformOrigin: "top left"});
TweenMax.set(armR, {x: -93, y: 220, rotation: -105, transformOrigin: "top right"});