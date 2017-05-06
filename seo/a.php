<?php
// libs/a/a.charset.php
// (c) Yuri Popoff, Nov 2003, popoff.donetsk.ua
// A set of functions to process charsets

function _charset_count_bad($s)
{ //count "bad" symbols in russian, in windows-1251
  $r=0;
  for($i=0;$i<strlen($s);$i++)
  {
    switch($s[$i])
    {
      case '�':
      case '�':
      case '�':
      case '�':
        break;
      default:
        $c=ord($s[$i]);
        if($c>=0x80&&$c<0xc0||$c<32)
          $r++;
    }
  }
  return $r;
}

function _charset_count_chars($s)
{ //count "good" symbols in russian, in windows-1251
  $r=0;
  for($i=0;$i<strlen($s);$i++)
  {
    $c=ord($s[$i]);
    if($c>=0xc0)
      $r++;
  }
  return $r;
}

function _charset_count_pairs($s)
{ //count "bad" pairs of chars for a string in russian, in windows-1251
  $a=array(
    0 => '���',
    1 => '����',
    2 => '���',
    3 => '������������',
    4 => '���',
    5 => '���',
    6 => '�����������',
    7 => '�����',
    8 => '���',
    9 => '�������������',
    10 => '�������������',
    11 => '�����',
    12 => '�����',
    13 => '����',
    14 => '���',
    15 => '������������',
    16 => '���',
    17 => '�',
    18 => '��',
    19 => '���',
    20 => '������������������',
    21 => '��������������',
    22 => '�����������������������',
    23 => '������������������',
    24 => '��������������',
    25 => '������������������������',
    26 => '�����������������������������',
    27 => '��������',
    28 => '����������',
    29 => '����������������',
    30 => '���������',
    31 => '��������'
    );
  $b=array(
    0  => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    1  => '������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    2  => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    3  => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    4  => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    5  => '������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    6  => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    7  => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    8  => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    9  => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    10 => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    11 => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    12 => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    13 => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    14 => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    15 => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    16 => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    17 => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    18 => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    19 => '������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    20 => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    21 => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    22 => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    23 => '������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    24 => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    25 => '������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    26 => '������������������������������������������������������������������������������������������������������������������',
    27 => '������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    28 => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    29 => '����������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    30 => '������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    31 => '��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������',
    );
  $res=0;
  for($i=0;$i<strlen($s)-1;$i++)
  {
    $c1=$s[$i];
    if($c1<'�'||$c1>'�') continue;
    $c2=$s[$i+1];
    if($c2<'�'||$c2>'�') continue;
    $i1=ord($c1)-ord('�');
    if(strpos($a[$i1],$c2)!==false)
    {
      $res++;
      continue;
    }
    if($i>=strlen($s)-2) continue;
    $c3=$s[$i+2];
    if($c3<'�'||$c3>'�') continue;
    $i2=ord($c2)-ord('�');
    if(strpos($a[$i2],$c3)!==false)
    {
      $res++;
      $i++;
      continue;
    }
    $l=0;
    $r=strlen($b[$i1])/2-1;
    while($l<=$r)
    {
      $c=$l+(($r-$l)>>1);
      $ca=$b[$i1][$c*2];
      $cb=$b[$i1][$c*2+1];
      if($ca==$c2&&$cb==$c3)
      {
        $res++;
        break;
      }
      if($ca<$c2||$ca==$c2&&$cb<$c3)
        $l=$c+1;
      else
        $r=$c-1;
    }
  }
  return $res;
}

function _charset_alt_win($s)
{
  for($i=0;$i<strlen($s);$i++)
  {
    $c=ord($s[$i]);
    if($c>=0x80&&$c<=0x9f)
      $s[$i]=chr($c-0x80+0xc0);
    else if($c>=0xa0&&$c<=0xaf)
      $s[$i]=chr($c-0xa0+0xe0);
    else if($c>=0xc0&&$c<=0xdf)
      $s[$i]=chr($c-0xc0+0x80);
    else if($c>=0xf0&&$c<=0xff)
      $s[$i]=chr($c-0xf0+0xa0);
  }
  return $s;
}

function _charset_koi_win($s)
{
  $kw = array(
    //00   01   02   03   04   05   06   07   08   09   0a    0b   0c    0d   0e   0f
    0x80, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138,  139, 140,  141, 142, 143, //0x80 - 0x8f
     144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 154, 0xbb, 156, 0xab, 158, 159, //0x90 - 0x9f
     160, 161, 162, 184, 164, 165, 166, 167, 168, 169, 170,  171, 172,  173, 174, 175, //0xa0 - 0xaf
     176, 177, 178, 179, 180, 181, 182, 183, 184, 185, 186,  187, 188,  189, 190, 191, //0xb0 - 0xbf
     254, 224, 225, 246, 228, 229, 244, 227, 245, 232, 233,  234, 235,  236, 237, 238, //0xc0 - 0xcf
     239, 255, 240, 241, 242, 243, 230, 226, 252, 251, 231,  248, 253,  249, 247, 250, //0xd0 - 0xdf
     222, 192, 193, 214, 196, 197, 212, 195, 213, 200, 201,  202, 203,  204, 205, 206, //0xe0 - 0xef
     207, 223, 208, 209, 210, 211, 198, 194, 220, 219, 199,  216, 221,  217, 215, 218  //0xf0 - 0xff
     );
  for($i=0;$i<strlen($s);$i++)
  {
    $c=ord($s[$i]);
    if($c>=128)
      $s[$i]=chr($kw[$c-128]);
  }
  return $s;
}

function _charset_utf8_win($s)
{
  $r='';
  $state=1;
  for ($i=0;$i<strlen($s);$i++)
  {
    $c=ord($s[$i]);
    switch($state)
    {
      case 1: //not a special symbol
        if($c<=127)
        {
          $r.=$s[$i];
        }
        else
        {
          if(($c>>5)==6)
          {
            $c1=$c;
            $state=2;
          }
          else
            $r.=chr(128);
        }
        break;
      case 2: //an utf-8 encoded symbol has been meet
        $new_c2=($c1&3)*64+($c&63);
        $new_c1=($c1>>2)&5;
        $new_i=$new_c1*256+$new_c2;
        switch($new_i)
        {
          case   1025: $out_c='�'; break;
          case   1105: $out_c='�'; break;
          case 0x00ab: $out_c='�'; break;
          case 0x00bb: $out_c='�'; break;
          default: $out_c=chr($new_i-848);
        }
        $r.=$out_c;
        $state=1;
        break;
    }
  }
  return $r;
}

function _charset_prepare($s)
{
  $r=0;
  $k=0;
  for($i=0;$i<strlen($s)&&$r<255;$i++)
  {
    $c=ord($s[$i]);
    if($c>=0x80)
    {
      $r++;
      $k=$i;
    }
  }
  return substr($s,0,$k+1);
}

function charset_win_lowercase($s)
{
  for($i=0;$i<strlen($s);$i++)
  {
    $c=ord($s[$i]);
    if($c>=0xc0&&$c<=0xdf)
      $s[$i]=chr($c+32);
    else if($s[$i]>='A'&&$s[$i]<='Z')
      $s[$i]=chr($c+32);
  }
  return $s;
}

function charset_x_win($s)
{
// returns a string converted from a best encoding (windows-1251 or koi-8r) to windows-1251
  $sa=_charset_prepare($s);
  $s1=charset_win_lowercase($sa);
  $r1='windows-1251';

  $c1=_charset_count_chars($s1);
  $b1=_charset_count_bad($s1);
  $p1=_charset_count_pairs($s1);
  $w1=$p1*32+$b1*64-$c1;

  $s2=charset_win_lowercase(_charset_koi_win($sa));
  $w2=-$c1; //����������� ��������� koi-8r: ��� �� �������� ��������, ��� � ��� windows-1251
  if($w2<$w1)
  {
    $b2=_charset_count_bad($s2);
    $w2+=64*$b2;
    if($w2<$w1)
    {
      $p2=_charset_count_pairs($s2);
      $w2+=32*$p2;
      if($w2<$w1)
      {
        $r1='koi-8r';
        $w1=$w2;
      }
    }
  }

  $s2=charset_win_lowercase(_charset_utf8_win($sa));

  $c2=_charset_count_chars($s2);
  $w2=-$c2;
  if($w2<$w1)
  {
    $b2=_charset_count_bad($s2);
    $w2+=64*$b2;
    if($w2<$w1)
    {
      $p2=_charset_count_pairs($s2);
      $w2+=32*$p2;
      if($w2<$w1)
      {
        $r1='utf';
        $w1=$w2;
      }
    }
  }

  switch($r1)
  {
    case 'alt':
      return _charset_alt_win($s);
    case 'koi-8r':
      return _charset_koi_win($s);
    case 'utf':
      return _charset_utf8_win($s);
    default:
      return $s;
  }

  return $s;
}

echo charset_x_win("����>�?�?���?");

?>